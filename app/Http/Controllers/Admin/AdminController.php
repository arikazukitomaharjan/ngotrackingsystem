<?php
namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin\Admin;
use Request;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;
use App\UserprofileTemp;
use App\Usermeta;
use App\Userprofile;
use Config;
use App\Memberforclient;
use Excel;
use Image;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
        {
            return Redirect::to('admin/dashboard');
        }

    public function login()
        {

            return view('admin.login');
        }

    public function loginAttempt()
        {
            if (Auth::attempt(array('email'=>Request::get('email'), 'password'=>Request::get('password') , 'role' => 'admin' ) ))
            {

                return Redirect::to('admin/dashboard');

            }else{

                Session::flash('message' , 'The email and password combination is invalid!');
                return Redirect::to('admin/login')->withInput();
            }
        }

   public function dashboard()
       {

            if(!$this->validateUser()){ return Redirect::to('/admin/login');}
            return view('admin.welcome');
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function user( $role )
        {
          //if(!$this->validateUser()){ return Redirect::to('/admin/login');}
           $curtime = time();
           $oneMonthAgo = $curtime - 2592000;
           $oneMonthAgo = date('Y-m-d H:i:s' , $oneMonthAgo );
           $newMember   = Admin::where( 'role' , '=' , $role)->where( 'created_at' , '>' , $oneMonthAgo)->count();
           $userList    = Admin::where( 'role' , '=' , $role )->orderBy('id', 'desc')->get();
           $regionList  = Usermeta::where( 'meta_type' , 'region' )->get();
           $title       = ucfirst($role);
           return view( 'admin.user-list' , compact( 'userList' , 'title' , 'regionList' , 'newMember') );
        }


    public function searchUserResult( $role )
          {

              $userList = Admin::getSearchResult(  $role , Request::all());
              $regionList  = Usermeta::where( 'meta_type' , 'region' )->get();
              $title    = ucfirst($role);
              return view( 'admin.user-list' , compact( 'userList' , 'title' , 'regionList' ,'role') );

          }


   public function form( $role , $id = NULL )
       {
           // if(! $this->validateUser()){ return Redirect::to('/admin/login');}
            /* add update user info starts */
            $input = Request::all();
            if( is_array( $input ) && !empty( $input ))
                {
                    $user  = new Admin();
                    if($id){
                        $user = Admin::find( $id );
                        if( trim( $input['password'] ) )
                            {
                                 $user->password      = Hash::make($input['password']);

                            }
                        }else{
                                $emailExist = Admin::where( 'email' , $input['email'] )->count();
                                if( $emailExist )
                                  {
                                    die( 'Error!! Email Already Exists!');
                                  }
                                    $str = '$.ABC$-_.+!*()D123$-_.+!*()45678EFGHIJK$-_.+!*()LMNO12345678P$-_.+!*()QRSTUVWXYZ12345678abcdef$-_.+!*()g12345678hijklmnop12345678q$-_.+!*()rstuvwxyz';
                                    $secondpart =   substr( str_shuffle(str_shuffle($str)) , 0 , 5);
                                    $userToken  =   substr($input['first_name'] , 0 , 5 ).$secondpart;
                                    $user->user_token=  $userToken ;

                                    $sendPassword = $input['password'] ;
                                    $user->password      = Hash::make($input['password']);

                                if( $role == 'member')
                                   {
                                         $this->sendLoginLink(  $input['first_name'] , $input['email'] , $user->user_token , $sendPassword );

                                   }else if( $role == 'client' ){

                                          $this->sendLoginLinkToClient( $input['email'] , $user->user_token , $sendPassword);
                                   }

                        }
                    $user->firstName     = $input['first_name'];
                    $user->lastName      = $input['last_name'];
                    $user->email         = $input['email'];

                    $user->role          = $input['role'];
                    $user->status        = $input['status'];

                    if(isset($input['expiry'])){
                       $user->expiry_date        = $input['expiry'];
                    }


                   $user->save();



                    return Redirect::to('admin/user/' . $user->role)->with('');
                }
                /* add update user info ends */

              /* form data starts */
               $userId = (int)$id;
               $formData = $this -> getFormData( $userId );
              /*form data ends */

            $title = ucfirst($role);
            if( $id ){

                return view('admin.update-user-form' , compact( 'title' , 'formData' ));

            }else{

                return view('admin.add-user-form' , compact( 'title' , 'formData' ));
            }

       }

       public function delete( $role , $id )
           {
               if(! $this->validateUser()){ return Redirect::to('/admin/login');}
               $user = Admin::find( $id );
               $user->delete();
               return redirect::to('admin/user/' . $role);
           }

      public function getAssignMember( $id )
        {
            $uploadPath  = Config::get('constants.UPLOAD_PATH');
            $assignList  = Userprofile::getAssignedMemberList( $id );
            $profileList = Userprofile::getMemberList( $id );
            return view('admin.assign-list' , compact( 'uploadPath' , 'profileList' , 'assignList' ));
        }

        public function asssignMembersToClient()
          {

              $assign = new Memberforclient;
              $assign->client_id = Request::get( 'client_id' );
              $assign->member_id = Request::get( 'member_id' );
              $assign->save();
          }

          public function deAssignMember()
          {

             $where = array( 'member_id' => Request::get( 'member_id' ) , 'client_id' => Request::get( 'client_id' ));
             Memberforclient::where( $where )->delete();

          }


    private function getFormData( $userId )
    {

        if($userId){

            $userw = Admin::where( 'id' , '=' , $userId )->first();

        }else{

            $user['id']             = '';
            $user['firstName']      = '';
            $user['lastName']       = '';
            $user['email']          = '';
            $user['password']       = '';
            $user['introduction']   = '';
            $user['role']           = '';
            $user['status']         = '';
            $user['created_at']     = '';
            $user['updated_at']     = '';
            $user['expiry_date']    = '';
            $userw = json_decode(json_encode($user)) ;


        }
        return $userw;

    }
    public function logout()
        {
            Auth::logout();
            Session::flush();
            return Redirect::intended('admin/login');
        }



    public function getSubmittedProfile()
        {
             if(! $this->validateUser()){ return Redirect::to('/admin/login');}
             $submissions = userprofileTemp::getAllSubmissions();
             $pendings    = Admin::where(array('status'=>'pending','role'=>'member'))->get();
             return view('admin.submitted-profile' , compact( 'submissions' , 'pendings'));
        }
      public function getPaymentButNoSubmission()
        {
             if(! $this->validateUser()){ return Redirect::to('/admin/login');}
             $payments = Admin::where('status' , '-' )->get();
             return view('admin.payment-but-no-submission' , compact( 'payments'));
        }

  public function getUserDelete($userId)
      {
          if(! $this->validateUser()){ return Redirect::to('/admin/login');}
          Admin::where('id',$userId)->delete();
          return Redirect::to('/admin/payment-but-no-submission');
      }


    public function getSubmissionEdit( $userId )
        {
           //if(! $this->validateUser()){ return Redirect::to('/admin/login');}
            $userRegion = '';
            $language        = Usermeta::where( 'meta_type' , '=' , 'langue' )->get();
            $languageLevel   = Usermeta::where( 'meta_type' , '=' , 'langue-level' )->get();
            $eye             = Usermeta::where( 'meta_type' , '=' , 'yeux' )->get();
            $hair            = Usermeta::where( 'meta_type' , '=' , 'cheveux' )->get();
            $disponibilites  = Usermeta::where( 'meta_type' , '=' , 'disponibilites' )->get();
            $regionList      = Usermeta::where( 'meta_type' , 'region' )->get();
            $user            = userprofileTemp::where ( 'user_id' , $userId )->first();
            if(!$user){

              $user            = userprofile::where ( 'user_id' , $userId )->first();
              $userRegion      = Admin::where('id',$userId)->pluck('region');
            }

            return view('admin.verify-submission' , compact( 'language' , 'languageLevel' , 'eye' , 'hair' , 'disponibilites' , 'user' ,'regionList' , 'userRegion' ));
        }
  public function getSubmissionDelete( $userId )
        {

            userprofileTemp::where('user_id' , $userId )->delete();
            return Redirect::to('/admin/submitted-profile');

        }
    public function verifySubmission( $id )
        {
           /*
            $submission = UserprofileTemp::where('id', $id )->first();
            if(!$submission){

                return Redirect::to('/admin/submitted-profile');
            }
            $data = array(
                    'age'                   => $submission->age,
                    'taille'                => $submission->taille,
                    'poids'                 => $submission->poids,
                    'cheveux'               => $submission->cheveux,
                    'yeux'                  => $submission->yeux,
                    'introduction'          => $submission->introduction,
                    'abroad_mission'        => $submission->abroad_mission,
                    'langue_maternelle'     => $submission->langue_maternelle,
                    'autres_langues'        => $submission->autres_langues,
                    'disponibilites'        => $submission->disponibilites,
                    'grande_qualite'        => $submission->grande_qualite,
                    'Ce_que_jaime'          => $submission->Ce_que_jaime,
                    'pourquoi_moi'          => $submission->pourquoi_moi,
                    'photo_de_profil'       => $submission->photo_de_profil,
                    'photo_supplementaires' => $submission->photo_supplementaires,
                    'id_scan'               => $submission->id_scan,
                );

             $isProfileExist = Userprofile::where( 'user_id', $submission->user_id )->first();
            if( $isProfileExist ){
                Userprofile::where( 'user_id', $submission->user_id)->update($data);
                $this->notifyUserProfileReviewed( $submission->user_id );
            }else{

                 $data['user_id'] = $submission->user_id;
                 Userprofile::insert($data);

                 $today = date('Y-m-d');
                 $expirydate = date('Y-m-d', strtotime("+90 days"));
                 $update = array('published_date' => $today , 'expiry_date' => $expirydate );
                 Admin::where( 'id', $submission->user_id)->update( $update );
                 $this->notifyUserProfilePublished( $submission->user_id );

            }




            Admin::where( 'id', $submission->user_id )->update( array('status' => 'published' , 'region' => $submission->region));


            UserprofileTemp::where('id', $id )->delete();
            */

                $profilePic = $this->upload( 'profilepic' , 'old_profilepic' , 259 , 374 );
                $image1     = $this->upload( 'photo1' , 'old_photo1' , 757 , 394 );
                $image2     = $this->upload( 'photo2' , 'old_photo2' , 757 , 394  );
                $image3     = $this->upload( 'photo3' , 'old_photo3' , 757 , 394  );
                $image4     = $this->upload( 'photo4' , 'old_photo4' , 757 , 394  );
                $idscan     = $this->upload( 'id_scan' , 'old_id_scan' );
                $photos     = array_filter(array( $image1 , $image2 , $image3 , $image4 ));
                $othetLanguage = array(
                        array ('language' => Request::get('language_2'),'level' =>  Request::get('level_2')),
                        array ('language' => Request::get('language_3'),'level' =>  Request::get('level_3'))
                    );
                $input = Request::all();
                $input['profilepic']  = $profilePic;
                $input['photos']      = $photos;
                $input['languages']   = $othetLanguage;
                $input['id_scan']     =  $idscan;
                $isProfileExist = Userprofile::where( 'user_id', $id )->first();
                if($isProfileExist){
                  $this->notifyUserProfileReviewed( $id );
                  Userprofile::addUpdateProfile( $id , $input , 'update');
                }else{
                  $this->notifyUserProfilePublished( $id );
                  Userprofile::addUpdateProfile( $id , $input ,'insert' );
                }

                Admin::where('id',$id)->update(array('region' => $input['region']));


               return Redirect::to('/admin/submitted-profile');

        }

    public function rejectSubmission( $id )
        {
             if(!$this->validateUser()){ return Redirect::to('/admin/login');}
             UserprofileTemp::where('id', $id )->update(['status' => 'rejected']);
             $message = Request::get('message');
             $this->sendRejectionEmail( $id , $message  );
             return Redirect::to('/admin/submitted-profile');
        }


    public function importUser( $role )
      {
            $rootDir   = $_SERVER['DOCUMENT_ROOT'];
            $uploadDir = $rootDir.'/amaninbox/resources/static-content/uploads/import-files/';
            $fileName  = $_FILES['input_file']["name"];
            if( $fileName )
            {
                $ext       = pathinfo($fileName , PATHINFO_EXTENSION);
                $newName   = rand( 1 , 999 ).'_'.time().'.'.$ext;
                $target_file = $uploadDir.$newName;
                move_uploaded_file($_FILES['input_file']["tmp_name"], $target_file);

                $result = Excel::load( $target_file)->get();
                if($result)
                {
                    foreach($result as $row)
                    {
                      $password  = $this->generatePassword(); $sendPassword = $password;
                      $userToken = $this->createUserToken($row->first_name);

                      $isExist = Admin::where('email' , $row->email)->count();
                      if(!$isExist)
                      {
                            $data = array(
                                'firstName'  => $row->first_name,
                                'lastName'   => $row->last_name,
                                'email'      => $row->email,
                                'role'       => $role,
                                'password'   => Hash::make($password),
                                'user_token' => $userToken,
                                'status'     => 'pending',
                                'created_at' => date('Y-m-d h:i:s'),
                                'updated_at' => date('Y-m-d h:i:s')
                              );
                            Admin::insert( $data  );
                            $this->sendLoginLink( $row->first_name , $row->email , $userToken , $sendPassword );
                       }
                    }

              }
            }
            return Redirect::to('/admin/user/'.$role);
      }

    private function createUserToken( $firstName )
      {
            $str = '$.ABC$-_.+!*()D123$-_.+!*()45678EFGHIJK$-_.+!*()LMNO12345678P$-_.+!*()QRSTUVWXYZ12345678abcdef$-_.+!*()g12345678hijklmnop12345678q$-_.+!*()rstuvwxyz';
            $secondpart =   substr( str_shuffle(str_shuffle($str)) , 0 , 5);
            $userToken  =   substr($firstName , 0 , 5 ).$secondpart;
            return $userToken;
      }

    private function sendRejectionEmail( $submissionId , $review )
        {

            $userId =  UserprofileTemp::where('id', $submissionId )->pluck('user_id');
            $user = Admin::where( 'id' , $userId)->first();
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <contact@amaninabox.com>' . "\r\n";

            $subject  = 'Votre profil doit être modifié avant publication';
            $message  = '<p>Hello '.$user->firstName.', </p>';
            $message .= '<p>'.$review.'</p>
                          <p><a href="'.url('/user/login/'.$user->user_token).'">Re-submit</a></p>
                        <hr>
                         <p style="font-size:10px;font-style:itallic;">
                        <img src="'.url('/resources/assets/public/images/FooterAMB.jpg').'"> <br/>
                        Ce message (ainsi que toutes les pièces jointes) est confidentiel. Toute publication,
                         utilisation ou diffusion, même partielle, doit être autorisée préalablement. Si vous n\'êtes 
                         pas destinataire de ce message, merci d\'en avertir immédiatement l\'expéditeur.</P>';

                mail( $user->email , $subject , $message , $headers );

        }




     private function sendLoginLink( $firstName , $email , $userToken , $password )
            {

                $uniqueLoginUrl = url( 'user/login/'.$userToken );


                $headers  = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <contact@amaninabox.com>' . "\r\n";

                $subject  = 'Votre paiement est validé';
                $message = '<p>Cher Monsieur,</p>

                        <p>Nous vous confirmons la validation des dernières formalités. <p>

                        <p>Afin de créer votre profil, merci de bien vouloir vous rendre sur le lien suivant :  <br>' .$uniqueLoginUrl.'
                        
                        </p>

                        <p>Pour accéder à votre espace merci d’indiquer le mot de passe ci-après : <strong>'.$password.'</strong>
                        </p>
                        <p>Une fois votre profil crée, celui-ci devra faire l’objet d’une validation manuelle de la part de notre équipe afin de s’assurer de la conformité des éléments soumis par vos soins. <p>

                        <p>Notez que cette étape peut prendre jusqu’à 48h suivant l’envoi.  </p>

                        <p>Par ailleurs, sachez que vous pourrez à tout moment modifier votre profil depuis votre espace dédié. </p>

                        <p>Pour rappel, vous trouverez ci-après un lien vers les <a href="http://www.amaninabox.com/#%21cgv/c14v9">CGV</a> applicables à nos Accompagnateurs. <p>

                        <p>A très vite,<br/>
                        AMB – Recrutement</p>
                        <hr>
                        <p style="font-size:10px;font-style:itallic;">
                        <img src="'.url('/resources/assets/public/images/FooterAMB.jpg').'"> <br/>
                        Ce message (ainsi que toutes les pièces jointes) est confidentiel. Toute publication,
                         utilisation ou diffusion, même partielle, doit être autorisée préalablement. Si vous n\'êtes 
                         pas destinataire de ce message, merci d\'en avertir immédiatement l\'expéditeur.</P>';

                mail($email,$subject,$message,$headers);
            }

            private function validateUser()
                {
                    if( Auth::user())
                     {
                        if( Auth::user()->role == 'admin')
                        {
                            return true;

                        }

                     }
                     return false;
                }

          private function notifyUserProfilePublished( $userId )
            {

                $email      =  Admin::where('id', $userId )->pluck('email');
                $userToken  =  Admin::where('id', $userId )->pluck('user_token');
                $password   =  $this->generatePassword();

                 $uniqueProfilenUrl = url( 'user/profile/'.$userToken );
                 $to =   $email;


                $headers  = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <contact@amaninabox.com>' . "\r\n";

                $subject   = 'Votre profil est en ligne !';
                $message   = '<p>Cher Monsieur,</p>

                             <p> Votre profil est désormais publié dans notre catalogue. Vous pouvez y accéder à tout moment à l\'aide de vos identifiants (voir email précédent). </p> 

                             <p> La mise en ligne a eu lieu ce jour, et ce pour une durée minimale de 90 jours (votre période d\'essai). </p> 

                              <p> Au delà de cette période, nous déciderons de poursuivre ou non la collaboration <u> selon l’intérêt que votre profil aura suscité auprès de notre clientèle. </u> </p> 

                              <p> Si vous avez des améliorations à apporter, n\'hésitez pas à modifier votre profil directement depuis votre espace dédié. </p> 

                              <p> En vous souhaitant tous nos vœux de réussite. </p> 

                             <p> Bien à vous, <br/>

                              Guillaume<br/> 
                              AMB Support</p>
                              <hr>
                        <p style="font-size:10px;font-style:itallic;"> 
                        <img src="'.url('/resources/assets/public/images/FooterAMB.jpg').'"> <br/>
                         Ce message (ainsi que toutes les pièces jointes) est confidentiel. Toute publication,
                         utilisation ou diffusion, même partielle, doit être autorisée préalablement. Si vous n\'êtes 
                         pas destinataire de ce message, merci d\'en avertir immédiatement l\'expéditeur.</P>';


                if(mail( $to , $subject , $message , $headers )){
                 // Admin::where( 'id' ,$userId )->update( ['password' => Hash::make( $password )]);
                }
            }

          private function notifyUserProfileReviewed( $userId )
            {
                 $to     =  Admin::where('id', $userId )->pluck('email');


                $headers  = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <contact@amaninabox.com>' . "\r\n";

                $subject   = 'Vos modifications ont été validées ';
                $message   = '<p>Cher Monsieur,</p>

                          <p>Les modifications apportées à votre profil ont été validées par notre équipe. </p>

                          <p>Si vous avez d’autres améliorations en tête, n\'hésitez pas à les effectuer directement depuis votre espace dédié. </p>


                              <p>Guillaume <br/>
                              AMB – Support </p><hr>
                         <p style="font-size:10px;font-style:itallic;">
                        <img src="'.url('/resources/assets/public/images/FooterAMB.jpg').'"> <br/>
                        Ce message (ainsi que toutes les pièces jointes) est confidentiel. Toute publication,
                         utilisation ou diffusion, même partielle, doit être autorisée préalablement. Si vous n\'êtes 
                         pas destinataire de ce message, merci d\'en avertir immédiatement l\'expéditeur.</P>';

                mail( $to , $subject , $message , $headers );
            }


            private function generatePassword()
            {
                    //$name = preg_replace('/\s+/', '', $name );
                    $string = 'abc123xyzABCDEF456789defghijklmpqrs123456789tuvwGHIJ123456789KLMNPQRSTUVWXYZ123456789';
                    $password = substr (str_shuffle( str_shuffle( $string ) ) , 0, 10);
                    return $password;
            }

    private function sendLoginLinkToClient( $to , $userToken , $password)
      {

                $headers  = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <contact@amaninabox.com>' . "\r\n";

                $subject   = 'Votre sélection';
                $uniqueLoginUrl = url( 'user/login/'.$userToken );

                $message ='<p>Chère Madame,</p>
           
                  <p>Suite à notre échange, vous trouverez ci-après un lien (+ mot de passe) vous permettant d\'accéder à une sélection de profils établie selon les critères évoqués ensemble. </p>
                   
                  <p>Lien : <a href="'.$uniqueLoginUrl.'">'.$uniqueLoginUrl.'</a> </p>
                   
                  <p>Pour y accéder merci d\'indiquer le mot de passe suivant : <strong>'.$password.'</strong></p>
                   
                  <p>Merci de revenir vers nous (par email) afin de nous indiquer quel(s) profil(s) a retenu votre attention.</p>

                  <p>Une fois la disponibilité de l\'accompagnateur confirmée, nous reviendrons vers vous avec un devis chiffré. </p>
                   
                  <p>Bien cordialement, <br>

                  AMB – Service Clients </p> <hr>
                     <p style="font-size:10px;font-style:itallic;">
                    <img src="'.url('/resources/assets/public/images/FooterAMB.jpg').'"> <br/>
                    Ce message (ainsi que toutes les pièces jointes) est confidentiel. Toute publication,
                     utilisation ou diffusion, même partielle, doit être autorisée préalablement. Si vous n\'êtes 
                     pas destinataire de ce message, merci d\'en avertir immédiatement l\'expéditeur.</P>';

                      mail( $to , $subject , $message , $headers );
      }



    private function upload( $fieldName , $oldFileName , $width = NULL , $height = NULL)
                {


                    $rootDir   = $_SERVER['DOCUMENT_ROOT'];
                    $uploadDir = $rootDir.'/amaninbox/resources/static-content/uploads/user-images/full-size/';
                    $targetDir = $rootDir.'/amaninbox/resources/static-content/uploads/user-images/';
                    $fileName  = $_FILES[$fieldName]["name"];
                    if( $fileName )
                    {
                        $allowed    = array('jpg' , 'jpeg' , 'png');
                        $ext       = strtolower(pathinfo($fileName , PATHINFO_EXTENSION));


                            $newName   = rand( 1 , 999 ).'_'.time().'.'.$ext;
                            $target_file  = $uploadDir.$newName;
                            $resized_file = $targetDir.$newName;
                            @move_uploaded_file($_FILES[$fieldName]["tmp_name"], $target_file);
                            if(file_exists($target_file))
                              {
                                   if( in_array($ext, $allowed) and ($width or $height))
                                    {
                                         $img = Image::make($target_file);
                                         if($width and $height){
                                          $img->fit( $width, $height );

                                         }else if($height and !$width){

                                          $img->resize(null, $height, function ($constraint) {
                                              $constraint->aspectRatio();
                                          });
                                         }else if($width and !$height){
                                           $img->resize($width, null , function ($constraint) {
                                              $constraint->aspectRatio();
                                          });
                                         }

                                          $img->save($resized_file);
                                    }
                              }
                            return $newName;


                    }

                    return Request::get( $oldFileName );
                }

}

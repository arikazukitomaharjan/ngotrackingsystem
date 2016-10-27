<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;

use App\Http\Requests;
use Request;
use App\Http\Controllers\Controller;
use App\Usermeta;
use App\Admin\Setting;
use Auth;
use Redirect;
use Session;
use Config;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
        {
             if( null != Auth::user())
             {
                if( Auth::user()->role != 'admin')
                {
                    return Redirect::to('/admin/login');
                }
             }else{

               return Redirect::to('/admin/login');

             }
        }
    public function index()
        {
            //
        }

   

    public function PaymentGateway()
        {
            $setting = Setting::where( 'option' , 'payment-gateway' )->first();
            return view('admin.setting.payment-gateway' , compact( 'setting' ));
        }

        public function setPaymentGateway()
            {

                if( is_array( Request::all() ) && !empty( Request::all() ))
                { 
                    $settings = array(
                            'active'   => 'braintree',
                            'braintree' =>
                                    array(
                                            'environment'  => Request::get('environment'),
                                            'merchant_id'  => Request::get('merchant_id'),
                                            'public_key'   => Request::get('public_key'),
                                            'private_key'  => Request::get('private_key')
                                        )
                        );
                    $paymebntSetting = json_encode($settings);
                    Setting::where( 'option' , 'payment-gateway' )->update( array('value'=>$paymebntSetting) );
                    return Redirect::to('/admin/setting/payment-gateway');
                }

            }
/* - - - - - - - - - - - - - - - - - - - - - Usermeta Setting - - - - - - - - - - - - - - - - - - - */
    public function usermeta( $metaType )
        {
           
            $usermetaList = Usermeta::where('meta_type' , $metaType)->get();
            return view('admin.setting.usermeta-list' , compact( 'usermetaList' ));
        }

    public function getAddUsermeta( $metatype  )
             {
                
                return view('admin.setting.usermeta-add-form' , compact( 'meta' ) );
             }

    public function postAddUsermeta( $metatype  )
             {
               
                Usermeta::insert( array('meta_type'=> $metatype , 'meta_value' => Request::get( 'meta_value' )) );
                return Redirect::to('/admin/setting/usermeta/'.$metatype);
             }
     
    public function getEditUsermeta( $metatype , $metaId = NULL )
             {
                
                $meta = Usermeta::where('id', $metaId)->first();
                return view('admin.setting.usermeta-form' , compact( 'meta' ) );
             }

    public function postEditUsermeta( $metatype , $metaId = NULL )
             {
                
                Usermeta::where('id', $metaId)->update( array('meta_value' => Request::get( 'meta_value' )) );
                return Redirect::to('/admin/setting/usermeta/'.$metatype);
             }


    public function deleteUsermeta( $metatype , $metaId )
        {
            
                Usermeta::where('id', $metaId)->delete();
                return Redirect::to('/admin/setting/usermeta/'.$metatype);
        }

/* - - - - - - - - - - - - - - - - - - terms setting - - - - - - - - - - - - - - - - - - - - -  */
    public function getAcceptTerm()
        {
            $setting = Setting::where( 'option' ,'accept-term' )->first();
            return view('admin.setting.accept-term-form' , compact('setting'));
        }

    public function postAcceptTerm()
        {
            $a = array( 'accept_term_step_1' => Request::get('accept_term_step_1') , 'accept_term_step_2' => Request::get('accept_term_step_2') , 'accept_term_info' => Request::get('accept_term_info') , 'accept_term_error_message' => Request::get('accept_term_error_message'));
            $value = json_encode($a);
            Setting::where( 'option' ,'accept-term' )->update( array( 'value' => $value ));
            return Redirect::to('/admin/setting/accept-term');
        }

/* - - - - - - - - - - - - - - - - - error messages settings - - - - - - - - - - - - - - - - - - - -  */
    public function getErrorMessages()
        {
            $setting = Setting::where( 'option' ,'error-messages' )->first();
            return view('admin.setting.error-messages-form' , compact('setting'));
        }

    public function postErrorMessages()
        {
                $input = Request::all();
                unset($input['_token']);
                $string = json_encode($input);
                Setting::where( 'option' ,'error-messages' )->update( array( 'value' => $string ));
                return Redirect::to('/admin/setting/error-messages');
        }

        /* - - - - - - - - - - - - - - - - - error messages settings - - - - - - - - - - - - - - - - - - - -  */
    public function getpageHeads()
        {
            $setting = Setting::where( 'option' ,'page-heads' )->first();
            return view('admin.setting.page-heads-form' , compact('setting'));
        }

    public function postpageHeads()
        {
                $input = Request::all();
                unset($input['_token']);
                $string = json_encode($input);
                Setting::where( 'option' ,'page-heads' )->update( array( 'value' => $string ));
                return Redirect::to('/admin/setting/page-heads');
        }

 /* - - - - - - - - - - - - - - - - - - - - footer images setting - - - - - - - - - - - - -- - - - - */
    public function getFooterImages()
        {
            $images = Setting::where( 'option' , 'footer-images' )->first();
            return view( 'admin.setting.footer-images-list' , compact( 'images' ));
        }

    public function getAddFooterImages()
        {
            return view('admin.setting.add-footer-images-form');
        }

    public function postAddFooterImages()
        {
            $fileName = $this->upload( 'image' );
            if($fileName)
            {
                    $images = Setting::where( 'option' , 'footer-images')->pluck('value');
                    if( !$images )
                    {
                        $footerImages = array( $fileName );

                    }else
                    {
                        $footerImages = json_decode( $images , true );
                        array_push ($footerImages , $fileName );
                    }
                    $newList = json_encode($footerImages);
                    Setting::where( 'option' , 'footer-images' )->update( array( 'value' => $newList ));
            }
            
            return Redirect::to('/admin/setting/footer-images');
        }

    public function getFooterImageDelete( $imageName )
        {
              $images = Setting::where( 'option' , 'footer-images')->pluck('value');
              $footerImages = json_decode( $images , true );
              $fliped = array_flip( $footerImages );
              unset( $fliped[$imageName] );
              $refliped = array_flip( $fliped );
              $newList = json_encode($refliped);
              Setting::where( 'option' , 'footer-images' )->update( array( 'value' => $newList ));
              return Redirect::to('/admin/setting/footer-images');
        }

    private function upload( $fieldName  )
                {
                    
                    $rootDir   = Config::get('constants.UPLOAD_ROOT');
                    $uploadDir = $rootDir.'/footer-images/';
                    $fileName  = $_FILES[$fieldName]["name"];
                    if( !$fileName ){
                        return false;
                    }
                    $newName = '';
                    if( $fileName )
                    {
                        $ext       = pathinfo($fileName , PATHINFO_EXTENSION);
                        $newName   = rand( 1 , 999 ).'_'.time().'.'.$ext;
                        $target_file = $uploadDir.$newName;
                        move_uploaded_file($_FILES[$fieldName]["tmp_name"], $target_file);
                        return $newName;
                    }
                    
                    return $newName;
                }


    private function optionsExist( $option )
        {
            
            if (Setting::where('option', '=', $option)->exists()) {
                    
                    return true;
                }
                return false;
        }

    private function addUpdateOption( $settings )
        {
            foreach( $settings as $key=>$value)
                    {
                        $exists = $this->optionsExist( $key );
                        if($exists)
                        {

                        }else{

                        }
                    }
        }
}

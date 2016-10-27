<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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


class UserController extends Controller
{
    

    public function getLogin()
        { 
              
            return view('login');
        }

    public function postLogin()
        { 
                   
             if (Auth::attempt(array('email'=>Request::get('email'), 'password'=>Request::get('password') ) ))        
                {

                    return Redirect::to('/dashboard');

                }else{

                    Session::flash('message' , 'The email and password combination is invalid!');
                    return Redirect::to('/login');
                }
        }

        public function logout(){

            Auth::logout();
            Session::flush();
            return Redirect::to('/');
        }
            
   
}

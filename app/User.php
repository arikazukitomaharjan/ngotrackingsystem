<?php

    namespace App;

    use Illuminate\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    use DB;

    class User extends Model implements AuthenticatableContract , CanResetPasswordContract
    {

        use Authenticatable , CanResetPassword;

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name' , 'email' , 'password'];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = ['password' , 'remember_token'];





        public static function getUser($view)
        {

            return DB::table('users as u')
                ->where('role' , 'admin')
                ->leftJoin('working_zones as wz' , 'u.working_zone' , '=' , 'wz.id')
                ->select('u.*' , 'wz.name as wz_name')
                ->orderBy('last_login' )
                ->paginate($view);
        }


    }

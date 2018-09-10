<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< HEAD
//
// use App\Notifications\ResetPasswordNotification;
// use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;
use App\Notifications\MyOwnResetPassword;
=======
>>>>>>> desarrollo
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        // 'nombre_alum','correo_alum','contrasena_alum'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;
<<<<<<< HEAD
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new MyOwnResetPassword($token));
        $this->notify(new App\Notifications\MyOwnResetPassword($token));
    }
    public function getAuthPassword()

    {
        return $this->password;
    }
=======
    public function getAuthPassword()

{
    return $this->password;
}
>>>>>>> desarrollo
}

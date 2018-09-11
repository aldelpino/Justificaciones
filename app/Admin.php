<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyOwnResetPassword;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * Name set for primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id_admin';

    /**
     * Name set for admins table.
     *
     * @var string
     */
    protected $table = 'administrador';

    /**
     * Name of the guard to authenticate against.
     *
     * @var string
     */
    protected $guard = 'admins';

    /**
     * Set value for timestamps present.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario', 'contrasena'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new App\Notifications\MyOwnResetPassword($token));
    }

    /**
     * Custom name for username.
     *
     * @return string
     */
    public function username()
    {
        return 'usuario';
    }

    /**
     * Custom name for password.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}

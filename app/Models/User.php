<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
//para agregar un mutador debo importar una defición llamada attribute
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //metodo que recibe el mismo nombre del atibuto que deseo modificar
    protected function name(): Attribute
    {
        return new Attribute(
            //accesor: transforma el valor luego de estar almacenado
            //No modifican el valor en la BD, transforman la representación del registro
            /* get: function($value){
                return ucwords($value);//convierte la primera letra en mayúscula
            }, */

            //Funcion flecha:
            //no se usa la palabra "function" ni las "{}" ni la palabra "return" ni el ";"
            get: fn($value) => ucwords($value),

            //mutador: transforma el valor antes de almacenarlo
           /*  set: function($value){
                return strtolower($value); //convierte el valor en minuscula
            } */

            set: fn($value) => strtolower($value)
        );
    }
}

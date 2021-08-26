<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password','foto','tema','tipo_letra','fecha', 'tamano','rol_id'
    ];

    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function listado(){

        $users = DB::table("users")
            ->select(['users.id','users.nombre', 'r.name','users.email'])
            ->leftJoin('roles as r', 'users.rol_id', '=', 'r.id')
            ->whereNull('users.deleted_at')
            ->where('r.id','!=', 3)
            ->get();
        
        return $users;
    }

    public static function getUsers(){

        $users = DB::table("users")
            ->select(['users.id','users.nombre', 'r.name','users.email','users.foto'])
            ->leftJoin('roles as r', 'users.rol_id', '=', 'r.id')
            ->whereNull('users.deleted_at')
            ->where('r.id','!=', 3)
            ->get();
        
        return $users;
    }
}

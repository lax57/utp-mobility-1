<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Permission;
use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    const ADMIN = "Administrador";
    const JEFE = "Jefe";
    const COMISSION = "Comission de Viajes";
    const RECTORIA = "Rectoria";
    const SOLICITANTE = "Solicitante";
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_name','creation_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    
    public function comissionEvaluations()
    {
        return $this->hasMany('App\ComissionEvaluation');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    
    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    
    public function permissions()
    {
        $permission =  \Illuminate\Support\Facades\DB::table('permissions')
                    ->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                    ->join('roles', 'permission_role.role_id', '=', 'roles.id')
                    ->join('role_user', 'role_user.role_id', '=', 'roles.id')
                    ->join('users', 'role_user.user_id', '=', 'users.id')
                    ->where('users.id', Auth::user()->id)
                    ->select('permissions.name')
                    ->pluck('name')->toArray();
        return $permission;
    }
    
    public function hasPermission($permission){
        return in_array($permission, $this->permissions());
    }

    
    
    private function getUserRoleNames(){
        $roles = [];
        foreach(Auth::user()->roles as $roleTable){
            array_push($roles, $roleTable->name);
        }
        return $roles;
    }
    
    public function isAdmin()
    {
        return in_array(self::ADMIN, $this->getUserRoleNames());
    }
    
    public function isJefe()
    {
        return in_array(self::JEFE, $this->getUserRoleNames());
    }
    
    public function isComission()
    {
        return in_array(self::COMISSION, $this->getUserRoleNames());
    }
    
    public function isRectoria()
    {
        return in_array(self::RECTORIA, $this->getUserRoleNames());
    }
    
    public function isSolicitante()
    {
        return in_array(self::SOLICITANTE, $this->getUserRoleNames());
    }
//    
//    public function isEvaluator()
//    {
//        return $this->isJefe() || $this->isComission() || $this->isRectoria();
//    }
}

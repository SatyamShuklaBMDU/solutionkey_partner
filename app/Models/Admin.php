<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Log;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    protected $guarded=[];
    protected $guard = 'admins';
    protected $casts = [
        'password' => 'hashed',
        // 'permissions' => 'array'
    ];
    // public function hasPermission($permission)
    // {
    //     try {
    //         $userPermissions = json_decode($this->permission, true);
    //         if (!is_array($userPermissions)) {
    //             throw new \Exception('User permissions are not properly initialized');
    //         }
    //         if (in_array('all', $userPermissions)) {
    //             return true;
    //         }
    //         return in_array($permission, $userPermissions);
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return false;
    //     }
    // }


    
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'vendors';
    protected $guarded=[];
    protected $guard = 'admins';
    protected $casts = [
        'password' => 'hashed',
        // 'permissions' => 'array'
    ];
    public function hasPermission($permission)
    {
        // dd($permission);
        try {
            $userPermissions = json_decode($this->permission, true);
            if (!is_array($userPermissions)) {
                throw new \Exception('User permissions are not properly initialized');
            }
            if (in_array('all', $userPermissions)) {
                return true;
            }
            return in_array($permission, $userPermissions);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}

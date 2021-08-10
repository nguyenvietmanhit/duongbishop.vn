<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
  const KEY_ADMIN = 'admin';
  const KEY_USER = 'user';
  protected $primaryKey = 'id';
  protected $table = 'roles';
  public $guarded = ['_token', '_method'];

  public static function getRoles()
  {
    return Role::orderByDesc('id')->get();
  }

  public static function getRoleName($id)
  {
    $role = Role::find($id);
    if ($role) {
      return $role->name;
    }
    return '';
  }

  public static function isRoleAdmin($id)
  {
    $role = Role::find($id);
    if ($role && $role->key == self::KEY_ADMIN) {
      return TRUE;
    }
    return FALSE;
  }

  public static function isCurrentAdmin()
  {
    if (!session()->get('user')) {
      return FALSE;
    }
    $user = session()->get('user');
    $role = Role::find($user->role_id);
    if ($role && $role->key == self::KEY_ADMIN) {
      return TRUE;
    }
    return FALSE;
  }

  public static function isRoleUser($id)
  {
    $role = Role::find($id);
    if ($role && $role->key == self::KEY_USER) {
      return TRUE;
    }
    return FALSE;
  }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
  protected $primaryKey = 'id';
  protected $table = 'users';

  protected $guarded = ['_token'];

  protected static function booted()
  {
    static::deleted(function ($user) {
      // Xóa report tương ứng với user nếu có
      Report::where('user_id', $user->id)->delete();
    });
  }

  public static function isAccessReportUser($user, $report_id) {
    $report_ids = $user->report_id ? explode(',', $user->report_id) : [];
    if (in_array($report_id, $report_ids)) {
      return TRUE;
    }
    return FALSE;
  }
}

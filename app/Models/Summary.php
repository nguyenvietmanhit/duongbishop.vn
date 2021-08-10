<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Summary extends Model
{

  protected $primaryKey = 'id';
  protected $table = 'summaries';
  const KEY_CONTENT_SUMMARY = 'content_summary';
  const KEY_CONTENT_BIRTHDAY = 'content_birthday';
  const KEY_CONTENT_PEAK = 'content_peak';

  protected $guarded = ['_token'];

  public $timestamps = FALSE;

//  protected static function booted()
//  {
//    static::deleted(function ($summary) {
//      echo "<pre>" . __LINE__ . " " . __FILE__ . "<br />";
//      print_r("Dsasad");
//      echo "</pre>";
//      die;
//      // Cập nhật lại trạng thái chưa luận giải cho report này
//      Report::where('report_id', $summary->id)->update([
//        'status' => Report::IS_INTERPRET_INACTIVE
//      ]);
//    });
//  }
}

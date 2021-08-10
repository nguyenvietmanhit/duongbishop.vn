<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
  protected $primaryKey = 'id';
  protected $table = 'categories';
  public $guarded = ['_token', '_method'];


  protected static function booted()
  {
    self::deleted(function($category) {
      Product::where('category_id', $category->id)->delete();
    });
  }

  public static function getCategoryName($id) {
    if (!$id) {
      return '';
    }
    $category = Category::where('id', $id)->first('name')->toArray();
    if ($category) {
      return $category['name'];
    }

    return '';
  }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'news';
    public $guarded = ['_token', '_method'];

    public function categories() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

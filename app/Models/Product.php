<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'products';
    public $guarded = ['_token', '_method'];

    public function categories() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

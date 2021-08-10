<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pages';
    public $guarded = ['_token', '_method'];
    const KEY_TOP_PAGE = 'top_page';
    const KEY_INTRO = 'intro';

    public function categories() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

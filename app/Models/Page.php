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
    const KEY_TOP_PAGE_VIDEO = 'top_page_video';
    const KEY_TOP_PAGE_CONTENT_CUSTOM_INFO = 'content_custom_info';
    const KEY_INTRO = 'intro';
    const KEY_GUIDE_BUY_ACC = 'guide_buy_acc';
    const KEY_CHANGE_INFO_ACC = 'change_info_acc';
    const KEY_NEED_SELL_ACC = 'need_sell_acc';

    public function categories() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

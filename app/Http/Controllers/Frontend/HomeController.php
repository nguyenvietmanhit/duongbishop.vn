<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdGroup;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Content;
use App\Models\Digit;
use App\Models\DigitContent;
use App\Models\News;
use App\Models\Number;
use App\Models\NumberOfYear;
use App\Models\NumberOfYearContent;
use App\Models\Page;
use App\Models\Product;
use App\Models\Report;
use App\Models\Role;
use App\Models\Summary;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeController extends FrontendController
{

    public function index(Request $request)
    {
        \Helper::$seo_title = "Dượng Bi Shop - Shop Acc Đột Kích";
        \Helper::$seo_description = "Dượng Bi Shop - Shop Acc Đột Kích";
        \Helper::$seo_keyword = "Dượng Bi Shop - Shop Acc Đột Kích";

        $price = $request->get('price');
        $vip_ingame = $request->get('vip_ingame');
        $name = $request->get('name');
        $where_search = 'TRUE';
        if ($name) {
            $where_search .= " AND (products.name LIKE '%$name%' OR products.code LIKE '%$name%')";
        }
        if (is_numeric($price) && is_numeric($vip_ingame) && $price && $vip_ingame) {
            switch ($price) {
                case 1:
                    $where_search .= " AND products.price < 1000000 ";
                    break;
                case 2:
                    $where_search .= " AND products.price BETWEEN 1000000 AND 2000000";
                    break;
                case 3:
                    $where_search .= " AND products.price BETWEEN 2000000 AND 3000000 ";
                    break;
                case 4:
                    $where_search .= " AND products.price > 4000000 ";
                    break;
            }
            if ($vip_ingame != -1) {
                $where_search .= " AND products.vip_ingame = $vip_ingame";
            }
        }


//        $products = Product::whereRaw($where_search)->paginate(40);

        $page_top = Page::where("key", Page::KEY_TOP_PAGE)->first();
        $page_top_video = Page::where("key", Page::KEY_TOP_PAGE_VIDEO)->first();

//        $products = Product::has('categories')->with('categories', function ($category) {
//            $category->select(['id', 'name']);
//        })->orderBy('price', 'DESC')
//            ->orderBy('created_at', 'DESC')->take(15)->get()->toArray();

//        var_dump($where_search);
        $products = Product::whereRaw($where_search)
            ->where('status', \Helper::STATUS_ACTIVE)
            ->orderBy('price', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(36);
        $products->appends(request()->input())->links();
//            ->take(36)->get()->toArray();
        //Danh sách acc theo từng danh mục:

//        $product_solds = Product::whereRaw($where_search)
//            ->where('status', \Helper::STATUS_SOLD)
//            ->orderBy('price', 'DESC')
//            ->orderBy('created_at', 'DESC')->take(36)->get()->toArray();

        return view('frontends/homes/index', [
            'products' => $products,
            'page_top' => $page_top,
            'page_top_video' => $page_top_video,
//            'product_solds' => $product_solds,
//            'news' => $news,
//            'product_by_categories' => $product_by_categories,
        ]);
    }

    public function intro()
    {

        $page_intro = Page::where("key", Page::KEY_INTRO)->first();
        return view('frontends/homes/intro', [
            'page_intro' => $page_intro
        ]);
    }

    public function map()
    {
//        $page_intro = Page::where("key", Page::KEY_INTRO)->first();
        return view('frontends/homes/map', [
//            'page_intro' => $page_intro
        ]);
    }


    public function contact()
    {
        return view('frontends/homes/contact', [
//      'reports' => $reports
        ]);
    }

    public function guideBuyAcc()
    {
        \Helper::$seo_title = \Helper::$seo_description = \Helper::$seo_keyword = "HƯỚNG DẪN MUA ACC";
        $guide_buy_acc = Page::where("key", Page::KEY_GUIDE_BUY_ACC)->first();
        return view('frontends/homes/guide_buy_acc', [
            'guide_buy_acc' => $guide_buy_acc
        ]);
    }

    public function changeInfoAcc()
    {
        \Helper::$seo_title = \Helper::$seo_description = \Helper::$seo_keyword = "HƯỚNG DẪN THAY ĐỔI THÔNG TIN ACC";
        $change_info_acc = Page::where("key", Page::KEY_CHANGE_INFO_ACC)->first();
        \Helper::$seo_title = \Helper::$seo_keyword = \Helper::$seo_description = $change_info_acc['name'];
        return view('frontends/homes/change_info_acc', [
            'change_info_acc' => $change_info_acc
        ]);

    }

    public function needSellAcc()
    {
        \Helper::$seo_title = \Helper::$seo_description = \Helper::$seo_keyword = "CẦN BÁN HAY THUÊ ACC CF";
        $need_sell_acc = Page::where("key", Page::KEY_NEED_SELL_ACC)->first();
        \Helper::$seo_title = \Helper::$seo_keyword = \Helper::$seo_description = $need_sell_acc['name'];
        return view('frontends/homes/need_sell_acc', [
            'need_sell_acc' => $need_sell_acc
        ]);
    }

    public function testInfo() {
        phpinfo();
    }
}

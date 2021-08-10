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

    public function index()
    {
        $page_top = Page::where("key", Page::KEY_TOP_PAGE)->first();
        $products = Product::has('categories')->with('categories', function ($category) {
            $category->select(['id', 'name']);
        })->orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')->take(15)->get()->toArray();
        //Danh sách sản phẩm theo từng danh mục:
        $categories = Category::all()->toArray();
        $product_by_categories = [];
        foreach ($categories AS $key => $category) {
            $product_categoriess = Product::where('category_id', $category['id'])->get()->toArray();
            if (!$product_categoriess) {
                continue;
            }
            $product_by_categories[$key]['products'] = $product_categoriess;
            $product_by_categories[$key]['category_id'] = $category['id'];
            $product_by_categories[$key]['category_name'] = $category['name'];
        }

        $news = News::orderBy('updated_at', 'DESC')
                ->orderBy('created_at', 'DESC')->take(3)->get();
        return view('frontends/homes/index', [
            'products' => $products,
            'page_top' => $page_top,
            'news' => $news,
            'product_by_categories' => $product_by_categories,
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
}

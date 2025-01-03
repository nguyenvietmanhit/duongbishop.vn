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
use App\Models\Number;
use App\Models\NumberOfYear;
use App\Models\NumberOfYearContent;
use App\Models\Product;
use App\Models\Report;
use App\Models\Role;
use App\Models\Summary;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductController extends FrontendController
{

    public function detail(Request $request, $product_name, $product_id)
    {
        $product = Product::where('status', \Helper::STATUS_ACTIVE)->findOrFail($product_id);
        \Helper::$seo_title = $product->name;
        \Helper::$seo_description = $product->name;
        \Helper::$seo_keyword = $product->name;
        $product_relatives = Product::where('products.id', '!=', $product_id)
            ->where('status', \Helper::STATUS_ACTIVE)
            ->take(10)->get();
        return view('frontends/products/detail', [
            'product' => $product,
            'product_relatives' => $product_relatives,
        ]);
    }

    public function allProduct(Request $request)
    {
        $search = $request->get('search');
        $where_search = 'TRUE';
        if ($search) {
            $search = strtolower($search);
            $where_search = " products.name LIKE '%$search%' OR products.content LIKE '%$search%'";
        }


        $products = Product::whereRaw($where_search)->where('status', \Helper::STATUS_ACTIVE)->paginate(12);
        return view('frontends/products/all', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function productSold() {
        $products = Product::where('status', \Helper::STATUS_SOLD)
            ->orderBy('price', 'DESC')
            ->orderBy('created_at', 'DESC')->paginate(36);

        return view('frontends/products/all', [
            'products' => $products,
            'title' => 'Các acc shop đã bán'
        ]);
    }


    public function contact()
    {
        return view('frontends/homes/contact', [
//      'reports' => $reports
        ]);
    }

    public function allProductByCategory($category_name, $category_id)
    {
        $products = Product::where('category_id', $category_id)
            ->where('status', \Helper::STATUS_ACTIVE)
            ->paginate(12);
        $category = Category::where('id', $category_id)->first()->toArray();
        return view('frontends/products/all', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}

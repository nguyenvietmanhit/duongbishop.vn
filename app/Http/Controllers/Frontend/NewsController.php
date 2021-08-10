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
use App\Models\News;
use App\Models\Report;
use App\Models\Role;
use App\Models\Summary;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class NewsController extends FrontendController
{

    public function detail(Request $request,$news_name, $news_id)
    {
        $news = News::findOrFail($news_id);
        $news_relatives = News::where('id', '!=', $news_id)
            ->take(10)->get();
        return view('frontends/news/detail', [
            'news' => $news,
            'news_relatives' => $news_relatives,
        ]);
    }

    public function allNews()
    {
        $news = News::paginate(12);
        return view('frontends/news/all', [
            'news' => $news
        ]);
    }


    public function contact()
    {
        return view('frontends/homes/contact', [
//      'reports' => $reports
        ]);
    }
}

<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdGroupController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DigitContentController;
use App\Http\Controllers\Admin\DigitController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NumberController;
use App\Http\Controllers\Admin\NumberOfYearController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SummaryController;
use App\Http\Controllers\Admin\UserController;

//use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Middleware\AnonymousCustom;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\AuthenticateUser;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

const ADMIN = 'admin';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([AuthenticateAdmin::class])
    ->prefix('admin')->group(function () {
        // User
        Route::get('users', [UserController::class, 'index']);
        Route::get('user/register', [UserController::class, 'register']);
        Route::post('user/registerSave', [UserController::class, 'registerSave']);
        Route::get('user/edit/{id}', [UserController::class, 'edit']);
        Route::get('user/detail/{id}', [UserController::class, 'detail']);
        Route::put('user/editSave/{id}', [UserController::class, 'editSave']);
        Route::delete('user/delete/{id}', [UserController::class, 'delete']);
//  Route::get('user/profile/{id}', [UserController::class, 'profile']);

        // Report
//    Route::get('reports', [ReportController::class, 'index']);
//    Route::get('report/edit/{id}', [ReportController::class, 'edit']);
//    Route::put('report/editSave/{id}', [ReportController::class, 'editSave']);
//    Route::delete('report/delete/{id}', [ReportController::class, 'delete']);

        //Content
        Route::get('content/create', [ContentController::class, 'create']);
        Route::post('content/createSave', [ContentController::class, 'createSave']);

        Route::get('content/detail/{id}', [ContentController::class, 'detail']);
        Route::get('content/edit/{id}', [ContentController::class, 'edit']);
        Route::put('content/editSave/{id}', [ContentController::class, 'editSave']);
        Route::delete('content/delete/{id}', [ContentController::class, 'delete']);
        Route::get('content/static', [ContentController::class, 'contentStatic']);

        //Number
        Route::get('numbers', [NumberController::class, 'index']);


        //Digit

        Route::get('digit/index/{key}', [DigitController::class, 'index']);
        Route::get('digit/edit/{id}', [DigitController::class, 'edit']);
        Route::put('digit/editSave/{id}', [DigitController::class, 'editSave']);
        //DigitContent

        Route::get('digit-content/duplicate/{digit_id}', [DigitContentController::class, 'duplicate']);
        Route::get('digit-content/create/{digit_id}', [DigitContentController::class, 'create']);
        Route::post('digit-content/createSave/{digit_id}', [DigitContentController::class, 'createSave']);
        Route::get('digit-content/delete/{digit_content_id}', [DigitContentController::class, 'delete']);

        //Role
        Route::get('role/create', [RoleController::class, 'create']);
        Route::post('role/createSave', [RoleController::class, 'createSave']);
        Route::get('roles', [RoleController::class, 'index']);
        Route::get('role/edit/{id}', [RoleController::class, 'edit']);
        Route::put('role/editSave/{id}', [RoleController::class, 'editSave']);
        Route::delete('role/delete/{id}', [RoleController::class, 'delete']);

        // Summary
        Route::get('summaries', [SummaryController::class, 'index']);
        Route::get('summary/create/{report_id}', [SummaryController::class, 'create']);
        Route::post('summary/createSave/{report_id}', [SummaryController::class, 'createSave']);
        Route::get('summary/edit/{report_id}', [SummaryController::class, 'edit']);
        Route::put('summary/editSave/{report_id}', [SummaryController::class, 'editSave']);
        Route::delete('summary/delete/{report_id}', [SummaryController::class, 'delete']);

        //Number of year
        Route::get('number-of-years', [NumberOfYearController::class, 'index']);
        Route::get('/number-of-year/edit/{id}', [NumberOfYearController::class, 'edit']);
        Route::put('/number-of-year/editSave/{id}', [NumberOfYearController::class, 'editSave']);


        //CAMPAIGN
        Route::get('campaign/upload', [CampaignController::class, 'upload']);
        Route::post('campaign/uploadSave', [CampaignController::class, 'uploadSave']);
        Route::get('campaign/report/{report_id}', [CampaignController::class, 'index']);

        // AD GROUP
        Route::get('ad-group/campaign/{campaign_id}', [AdGroupController::class, 'index']);

        //AD
        Route::get('ad/ad-group/{ad_group_id}', [AdController::class, 'index']);

        //REPORT
        Route::get('reports', [ReportController::class, 'index']);
        Route::get('report/create', [ReportController::class, 'create']);
        Route::post('report/createSave', [ReportController::class, 'createSave']);
        Route::get('report/edit/{report_id}', [ReportController::class, 'edit']);
        Route::post('report/editSave/{report_id}', [ReportController::class, 'editSave']);
        Route::delete('report/delete/{report_id}', [ReportController::class, 'delete']);


        // Category
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('category/create', [CategoryController::class, 'create']);
        Route::post('category/createSave', [CategoryController::class, 'createSave']);
        Route::get('category/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('category/editSave/{id}', [CategoryController::class, 'editSave']);
        Route::delete('category/delete/{id}', [CategoryController::class, 'delete']);


        // Product
        Route::get('/', [ProductController::class, 'index']);
        Route::get('products', [ProductController::class, 'index']);
        Route::get('product/create', [ProductController::class, 'create']);
        Route::post('product/createSave', [ProductController::class, 'createSave']);
        Route::get('product/edit/{id}', [ProductController::class, 'edit']);
        Route::put('product/editSave/{id}', [ProductController::class, 'editSave']);
        Route::delete('product/delete/{id}', [ProductController::class, 'delete']);

        // News
        Route::get('news', [NewsController::class, 'index']);
        Route::get('new/create', [NewsController::class, 'create']);
        Route::post('new/createSave', [NewsController::class, 'createSave']);
        Route::get('new/edit/{id}', [NewsController::class, 'edit']);
        Route::put('new/editSave/{id}', [NewsController::class, 'editSave']);
        Route::delete('new/delete/{id}', [NewsController::class, 'delete']);

        // Static page
        Route::get('pages', [PageController::class, 'index']);
        Route::get('page/create', [PageController::class, 'create']);
        Route::post('page/createSave', [PageController::class, 'createSave']);
        Route::get('page/edit/{id}', [PageController::class, 'edit']);
        Route::put('page/editSave/{id}', [PageController::class, 'editSave']);
        Route::delete('page/delete/{id}', [PageController::class, 'delete']);
    });


Route::middleware([AuthenticateUser::class])->group(function () {
    // Frontend
//  Route::get('/', [FrontendUserController::class, 'index']);
//  Route::post('/indexSave', [FrontendUserController::class, 'indexSave']);
//  Route::get('user/report/{report_id}', [FrontendUserController::class, 'report']);
    Route::get('user/logout', [FrontendUserController::class, 'logout']);
    Route::get('user/profile', [FrontendUserController::class, 'profile']);
    Route::put('user/profileSave', [FrontendUserController::class, 'profileSave']);
//  Route::get('list/report', [FrontendUserController::class, 'listReport']);
////  Route::get('printPdf/{report_id}', [FrontendUserController::class, 'printPdf']);
//  Route::get('{report_slug}-{report_id}.html', [FrontendUserController::class, 'report'])
//  ->where('report_slug', '^([0-9A-Za-z-]+)$')->name('report');
//  Route::get('/', [FrontendUserController::class, 'index']);
});

Route::middleware([AnonymousCustom::class])->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('gioi-thieu.html', [HomeController::class, 'intro']);
    Route::get('lien-he.html', [HomeController::class, 'contact']);
    Route::get('ban-do.html', [HomeController::class, 'map']);

    Route::get('user/login', [FrontendUserController::class, 'login']);
    Route::post('user/loginProcess', [FrontendUserController::class, 'loginProcess']);
    // Product
    Route::get('san-pham.html', [\App\Http\Controllers\Frontend\ProductController::class, 'allProduct']);
    Route::get('tim-kiem-san-pham.html', [\App\Http\Controllers\Frontend\ProductController::class, 'allProduct']);
    Route::get('san-pham/{product_name}-{product_id}.html', [\App\Http\Controllers\Frontend\ProductController::class, 'detail'])
        ->where('product_name', '^([0-9A-Za-z-]+)$');

    Route::get('danh-muc/{category_name}-{category_id_id}.html', [\App\Http\Controllers\Frontend\ProductController::class, 'allProductByCategory'])
        ->where('category_name', '^([0-9A-Za-z-]+)$');

    Route::get('tin-tuc.html', [\App\Http\Controllers\Frontend\NewsController::class, 'allNews']);
    Route::get('tin-tuc/{news_name}-{news_id}.html', [\App\Http\Controllers\Frontend\NewsController::class, 'detail'])
        ->where('news_name', '^([0-9A-Za-z-]+)$');
});

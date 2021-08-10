<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdGroup;
use App\Models\Campaign;
use App\Models\Content;
use App\Models\Digit;
use App\Models\DigitContent;
use App\Models\Number;
use App\Models\NumberOfYear;
use App\Models\NumberOfYearContent;
use App\Models\Report;
use App\Models\Role;
use App\Models\Summary;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UserController extends FrontendController
{

  public function index() {
    $user = session()->get('user');
    $report_ids = explode(',', $user->report_id);
    if (Role::isCurrentAdmin()) {
      $reports = Report::paginate(10);
    } else {
      $reports = Report::whereIn('id', $report_ids)->paginate(10);
    }
    return view('frontends/users/index', [
      'reports' => $reports
    ]);
  }

  public function report(Request $request, $report_slug, $report_id)
  {
    \Helper::$title_page = 'Trang chủ';
    \Helper::$seo_title = 'Trang chủ';
    \Helper::$seo_description = 'Trang chủ';
    \Helper::$seo_keyword = 'Trang chủ';

    $report = Report::findOrFail($report_id);
    if ($report_slug != $report->report_slug) {
      return redirect()->route('report', [
        'report_slug' => $report->report_slug,
        'report_id' => $report_id,
      ]);
    }

    $date_from = $request->get('date_from');
    $date_to = $request->get('date_to');


    // Lấy ra ngày xuất báo cáo lớn nhất
    $campaign_date_to = Campaign::selectRaw('MAX(DATE(date_to)) AS max_date_to')
      ->where('report_id', $report_id)->first()->toArray();
    $date_to_range = $campaign_date_to['max_date_to'];
    // Lấy ra ngày xuất báo cáo nhỏ nhất
    $campaign_date_from = Campaign::selectRaw('MIN(DATE(date_from)) AS min_date_from')
      ->where('report_id', $report_id)->first()->toArray();
    $date_from_range = $campaign_date_from['min_date_from'];

    if (!$date_from) {
      $date_from = $date_from_range;
    }

    if (!$date_to) {
      $date_to = $date_to_range;
    }

    if ($date_from < $date_from_range || $date_from > $date_to || $date_to > $date_to_range || $date_to < $date_from) {
      session()->put('error', 'Ngày không hợp lệ');
      return redirect('/');
    }

    $limit = 1000;
    $sql_raw = " ads.date_report BETWEEN '$date_from' AND '$date_to' ";
    // Lấy danh sách chiến dịch đang có trên hệ thông theo cơ chế phân trang
    $campaigns = Campaign::where('report_id', $report_id)->whereHas('adGroups', function($ad_group) use ($sql_raw) {
      $ad_group->whereHas('ads', function ($ad) use ($sql_raw) {
        $ad->whereRaw($sql_raw);
      });
    })->paginate($limit);
    $count_campaign = $campaigns->total();

    // Lấy danh sách nhóm quảng cáo có phân trang
//    $ad_groups = AdGroup::paginate($limit);
    $ad_groups = AdGroup::where('report_id', $report_id)->whereHas('ads', function ($ad) use ($sql_raw) {
        $ad->whereRaw($sql_raw);
      })
    ->paginate($limit);
    $count_ad_group = $ad_groups->total();

    // Lấy danh sách từng quảng cáo có phân trang
//    $ads = Ad::paginate($limit);
//    dump($ads = Ad::where('report_id', $report_id)->whereRaw($sql_raw)
//      ->distinct('name')
//      ->paginate($limit));
//    $ads = Ad::where('report_id', $report_id)->whereRaw($sql_raw)->get()->groupBy('ad_group_id');
////    dd($ads);
//    $ads = Ad::where('report_id', $report_id)->whereRaw($sql_raw)
//      ->distinct('name')
//      ->paginate($limit);
//
//    $ad_distincts = [];
////    $ads->items();
//    foreach ($ads AS $key => $ad) {
//      $ad_distincts[$ad['ad_group_id']] = $ad['name'];
//      $ads->push('dsadsa');
//    }


    $ads = Ad::where('report_id', $report_id)->whereRaw($sql_raw)->get()->groupBy('ad_group_id');

    $ad_items = [];
    foreach ($ads AS $ad_group_id => $ad_group_by) {
      $ad_model = new Ad();
      $statistic_totals = \Helper::getStatisticAd($ad_group_by);
      $ad_model->report_id = $ad_group_by[0]->report_id;
      $ad_model->report_id = $ad_group_by[0]->report_id;
      $ad_model->name = $ad_group_by[0]->name;
      $ad_model->objective = $ad_group_by[0]->objective;
      $ad_model->type_result = $ad_group_by[0]->type_result;
      $ad_model->total_result =  $statistic_totals['total_result'];
      $ad_model->total_reach =  $statistic_totals['total_reach'];
      $ad_model->total_display =  $statistic_totals['total_display'];
      $ad_model->total_budget =  $statistic_totals['total_budget'];
      $ad_model->total_register =  $statistic_totals['total_register'];
      $ad_model->total_click =  $statistic_totals['total_click'];
      $ad_model->total_cpc =  $statistic_totals['total_cpc'];
      $ad_model->total_interact =  $statistic_totals['total_interact'];
      $ad_model->total_cpr =  $statistic_totals['total_cpr'];
      $ad_model->date_report =  $ad_group_by[0]->date_report;
      $ad_model->date_from =  $ad_group_by[0]->date_from;
      $ad_model->date_to =  $ad_group_by[0]->date_to;
      $ad_items[] = $ad_model;

    }
    $ads = $ad_items;

    $count_ad = count($ads);


    // Lấy thông kê tổng cho cả 3 mục Chiến dịch, Nhóm quảng cáo, Quảng cáo
    // Lấy bảng Quảng cáo để tính chung

    $ad_statistics = Ad::where('report_id', $report_id)->whereRaw($sql_raw)->get()->toArray();
//    $statistic_totals = [
//      'total_result' => 0,
//      'total_reach' => 0,
//      'total_display' => 0,
//      'total_budget' => 0,
//      'total_register' => 0,
//      'total_click' => 0,
//      'total_cpc' => 0,
//      'total_interact' => 0,
//    ];
//    foreach ($ad_statistics AS $ad) {
//      $statistic_totals['total_result'] += $ad['total_result'];
//      $statistic_totals['total_reach'] += $ad['total_reach'];
//      $statistic_totals['total_display'] += $ad['total_display'];
//      $statistic_totals['total_budget'] += $ad['total_budget'];
//      $statistic_totals['total_register'] += $ad['total_register'];
//      $statistic_totals['total_click'] += $ad['total_click'];
//      $statistic_totals['total_cpc'] += $ad['total_cpc'];
//      $statistic_totals['total_interact'] += $ad['total_interact'];
//    }
    $statistic_totals = \Helper::getStatisticAd($ad_statistics);

    //Range date từ thời điểm tĩnh đến thời điểm hiện tại
//    $date_to = date('Y-m-d', strtotime(' + 1 days', strtotime($date_to)));
//    $period = new \DatePeriod(
//      new \DateTime($date_from),
//      new \DateInterval('P1D'),
//      new \DateTime($date_to)
//    );
    $range_dates = [];
//    $range_date_fulls = [];
    $statistic_by_days = [
      'impressions' => [],
      'budgets' => [],
      'reachs' => [],
    ];

    $date_ranges = \Helper::getDateRange($date_from, $date_to);
//    echo "<pre> >>> " . __FILE__ . "(" . __LINE__ . ")<br/>";
//    print_r($date_ranges);
//    echo "</pre>";

    foreach ($date_ranges AS $date) {
      $date_item = date('d-m-Y', strtotime($date));
//      $range_dates[] = "{$date->format('d-m')}";
//      $range_date_fulls[] = "{$date->format('Y-m-d')}";
      // Lấy các thống kê theo ngày
      // + Thống kê theo lượt hiển thị
      $ad_impressions = Ad::selectRaw('SUM(total_display) AS sum_total_display')
        ->where('date_report', $date)
        ->where('report_id', $report_id)
        ->first()->toArray();
      $sum_total_display = $ad_impressions['sum_total_display'] ?  $ad_impressions['sum_total_display'] : 0;
      $statistic_by_days['impressions'][$date_item] = $sum_total_display;

      // + Thống kê theo budget
      $ad_budgets = Ad::selectRaw('SUM(total_budget) AS sum_total_budget')
        ->where('date_report', $date)
        ->where('report_id', $report_id)
        ->first()->toArray();
      $sum_total_budget = $ad_budgets['sum_total_budget'] ?  $ad_budgets['sum_total_budget'] : 0;
      $statistic_by_days['budgets'][$date_item] = $sum_total_budget;

      // + Thống kê theo lượt tiếp cận
      $ad_reachs = Ad::selectRaw('SUM(total_reach) AS sum_total_reach')
        ->where('date_report', $date)
        ->where('report_id', $report_id)
        ->first()->toArray();
      $sum_total_reach = $ad_reachs['sum_total_reach'] ?  $ad_reachs['sum_total_reach'] : 0;
      $statistic_by_days['reachs'][$date_item] = $sum_total_reach;
    }

    // Tính impression/số lượt hiển thị theo từng ngày trong khoảng ngày trên
//    $range_date = implode(',', $range_date);
    return view('frontends.users.report', [
      'campaigns' => $campaigns,
      'count_campaign' => $count_campaign,
      'ad_groups' => $ad_groups,
      'count_ad_group' => $count_ad_group,
      'ads' => $ads,
      'count_ad' => $count_ad,
      'statistic_totals' => $statistic_totals,
      'statistic_by_days' => $statistic_by_days,
      'date_from' => $date_from,
      'date_to' => $date_to,
      'date_from_range' => $date_from_range,
      'date_to_range' => $date_to_range,
      'date_ranges' => $date_ranges,
      'sql_raw' => $sql_raw
    ]);
  }

  public function login()
  {
    \Helper::$title_page = 'Đăng nhập';
    return view('frontends.users.login');
  }

  public function loginProcess(Request $request)
  {

    $rules = [
      'username' => 'required',
      'password' => 'required',
    ];
    $messages = [
      'username.required' => 'Username không được để trống',
      'password.required' => 'Password không được để trống',
    ];

    $request->validate($rules, $messages);
    $user = User::where('username', $request->get('username'))->first();

    if (!$user) {
      session()->put('error', 'Tài khoản này không tồn tại');
      return redirect('user/login');
    }


    if (password_verify($request->get('password'), $user->password)) {
//      session()->put('success', 'Đăng nhập thành công');
      session()->put('user', $user);
      // Redirect base role
//      if (Role::isRoleAdmin($user->role_id)) {
//        return redirect('admin/reports');
//      }
      return redirect('/');
    } else {
      session()->put('error', 'Sai tài khoản hoặc mật khẩu');
      return redirect('user/login');
    }
  }

  public function logout()
  {
    session()->forget('user');
    session()->put('success', 'Đăng xuất thành công');
    return redirect('user/login');
  }

//  public function report(Request $request, $report_id)
//  {
//    \Helper::$title_page = 'Chi tiết báo cáo';
//
//    $report = Report::findOrFail($report_id);
//    \Helper::$url_print_pdf = url('printPdf/' . $report->id);
//    // Permisssion access report
//    if ($report->user_id != session()->get('user')->id) {
//      session()->put('error', 'Bạn không có quyền truy cập báo cáo này');
//      return redirect('/');
//    }
//    // Get report
//    $contents = [];
//    // 1/ Lấy danh sách trang tĩnh 1 đến 23 trên hệ thống
//    $contents_static_0 = Content::where('type', Content::TYPE_STATIC_FIXED)
//      ->orderBy('page_number', 'ASC')
//      ->get()->toArray();
//
//
//    // Lấy trang động 24, về user name
//    $contents_dynamic_1 = Content::where('type', Content::TYPE_DYNAMIC_USER_INFO)
//      ->orderBy('page_number', 'ASC')->get()->toArray();
//    if ($contents_dynamic_1) {
//      // Phân tích họ tên và ngày sinh của user với report hiện tại
//      $user_fullname = \Helper::getFormatInfoUser($report['user_fullname'], 'info-username');
//      $user_birthday = date('d/m/Y', strtotime($report['user_birthday']));
//      $user_birthday = \Helper::getFormatInfoUser($user_birthday, 'info-birthday');
//
//      $body = str_replace('{ho_ten}', $user_fullname, $contents_dynamic_1[0]['content']);
//      $body = str_replace('{ngay_sinh}', $user_birthday, $body);
//      $contents_dynamic_1[0]['content'] = $body;
//    }
//
//    // 2/ Lấy trang động 25, về các con số linh hồn, nhân cách, vận mệnh, ngày sinh, đường đời, thái độ
//    $contents_dynamic_2 = Content::where('type', Content::TYPE_DYNAMIC_NUMBER)
//      ->orderBy('page_number', 'ASC')->get()->toArray();
//    $numbers = [];
//    if ($contents_dynamic_2) {
//      // Phân tích họ tên và ngày sinh của user với report hiện tại
//      $numbers = \Helper::getNumbers($report['user_fullname'], $report['user_birthday']);
//      $body = $contents_dynamic_2[0]['content'];
//      $body = str_replace('{cslh}', $numbers['cslh'], $body);
//      $body = str_replace('{csnc}', $numbers['csnc'], $body);
//      $body = str_replace('{csvm}', $numbers['csvm'], $body);
//      $body = str_replace('{csns}', $numbers['csns'], $body);
//      $body = str_replace('{csdd}', $numbers['csdd'], $body);
//      $body = str_replace('{cstd}', $numbers['cstd'], $body);
//      $contents_dynamic_2[0]['content'] = $body;
//    }
//
//    $contents = array_merge($contents, $contents_static_0, $contents_dynamic_1, $contents_dynamic_2);
//
//    // 3/ Lấy trang động 256 - 46,là các template của từng con số dựa theo mảng $numbers vừa tính được
//    $digit_content_arr = [];
//    foreach ($numbers AS $number_key => $number_value) {
//      $number = Number::select(['name'])
//        ->where('key', $number_key)
//        ->first()->toArray();
//      // Lấy con số tương ứng dựa vào giá trị của số và key
//      $digit = Digit::where('number', $number_value)
//        ->where('key', $number_key)->first()->toArray();
//      // Lấy các page tương ứng với id vừa tìm đc
//      $digit_contents = DigitContent::where('digit_id', $digit['id'])->get()->toArray();
//      foreach ($digit_contents AS $key => $digit_content) {
//        $digit_content_arr[$number_key][$key]['digit_id'] = $digit_content['digit_id'];
//        $digit_content_arr[$number_key][$key]['number_name'] = $number['name'];
//        $digit_content_arr[$number_key][$key]['number_value'] = $number_value;
//        $digit_content_arr[$number_key][$key]['content'] = $digit_content['content'];
//      }
//    }
//    // 4/ Lấy trang động 47, 48 - Là luận giải riêng của phần Tổng quát
//    $content_summaries = Summary::where('report_id', $report_id)
//      ->where('key', Summary::KEY_CONTENT_SUMMARY)->get()->toArray();
//
//    // 5/ Lấy trang template tĩnh 49, Trang biểu đồ ngày sinh
//    $content_chart_birthday = Content::where('type', Content::TYPE_CHART_BIRTHDAY)
//      ->first()->toArray();
//
//    $user_birthday = $report['user_birthday'];
//    $results_birthday = \Helper::getChartBirthday($user_birthday);
//    $chart_birthday = str_replace('{d}', $results_birthday['d'], $content_chart_birthday['content']);
//    $chart_birthday = str_replace('{m}', $results_birthday['m'], $chart_birthday);
//    $chart_birthday = str_replace('{y}', $results_birthday['y'], $chart_birthday);
//    $chart_birthday = str_replace('{dt}', $results_birthday['dt'], $chart_birthday);
//    $chart_birthday = str_replace('{mt}', $results_birthday['mt'], $chart_birthday);
//    $chart_birthday = str_replace('{yt}', $results_birthday['yt'], $chart_birthday);
//
//    $chart_birthday = str_replace('{11}', $results_birthday['11'], $chart_birthday);
//    $chart_birthday = str_replace('{12}', $results_birthday['12'], $chart_birthday);
//    $chart_birthday = str_replace('{13}', $results_birthday['13'], $chart_birthday);
//    $chart_birthday = str_replace('{21}', $results_birthday['21'], $chart_birthday);
//    $chart_birthday = str_replace('{22}', $results_birthday['22'], $chart_birthday);
//    $chart_birthday = str_replace('{23}', $results_birthday['23'], $chart_birthday);
//    $chart_birthday = str_replace('{31}', $results_birthday['31'], $chart_birthday);
//    $chart_birthday = str_replace('{32}', $results_birthday['32'], $chart_birthday);
//    $chart_birthday = str_replace('{33}', $results_birthday['33'], $chart_birthday);
//
//    $content_chart_birthday['content'] = $chart_birthday;
//
//    // 5/ Lấy trang động 50 - 53 - Là luận giải riêng của Biểu đồ ngày sinh
//    $content_birthdays = Summary::where('report_id', $report_id)
//      ->where('key', Summary::KEY_CONTENT_BIRTHDAY)->get()->toArray();
//
//    // 6/ Lấy trang template tĩnh 54 - Đỉnh cao đời người
//    $content_peak_template = Content::where('type', Content::TYPE_PEAK)
//      ->first()->toArray();
//    $content_peak_content = str_replace('{dt}', $results_birthday['dt'], $content_peak_template['content']);
//    $content_peak_content = str_replace('{mt}', $results_birthday['mt'], $content_peak_content);
//    $content_peak_content = str_replace('{yt}', $results_birthday['yt'], $content_peak_content);
//    $mtdt = $results_birthday['dt'] + $results_birthday['mt'];
//    $mtdt = array_sum(str_split($mtdt));
//    $mtdt = array_sum(str_split($mtdt));
//    $content_peak_content = str_replace('{mtdt}', $mtdt, $content_peak_content);
//
//    $dtyt = $results_birthday['dt'] + $results_birthday['yt'];
//    $dtyt = array_sum(str_split($dtyt));
//    $dtyt = array_sum(str_split($dtyt));
//    $content_peak_content = str_replace('{dtyt}', $dtyt, $content_peak_content);
//
//    $total1 = $mtdt + $dtyt;
//    $total1 = array_sum(str_split($total1));
//    $total1 = array_sum(str_split($total1));
//    $content_peak_content = str_replace('{total1}', $total1, $content_peak_content);
//
//    $total2 = $results_birthday['mt'] + $results_birthday['yt'];
//    $total2 = array_sum(str_split($total2));
//    $total2 = array_sum(str_split($total2));
//    $content_peak_content = str_replace('{total2}', $total2, $content_peak_content);
//
//    $d1 = 36 - $numbers['csdd'];
//    $d2 = $d1 + 9;
//    $d3 = $d2 + 9;
//    $d4 = $d3 + 9;
//    $content_peak_content = str_replace('{d1}', $d1, $content_peak_content);
//    $content_peak_content = str_replace('{d2}', $d2, $content_peak_content);
//    $content_peak_content = str_replace('{d3}', $d3, $content_peak_content);
//    $content_peak_content = str_replace('{d4}', $d4, $content_peak_content);
//    $content_peak_template['content'] = $content_peak_content;
//
//    // 7/ Lấy trang động 55, 57 - Là luận giải riêng của phần Đỉnh cao đời người
//    $content_peaks = Summary::where('report_id', $report_id)
//      ->where('key', Summary::KEY_CONTENT_PEAK)->get()->toArray();
//
//    // 8 / Con số của năm = năm hiện tại + tháng sinh + ngày sinh
//    $user_birthday = $report['user_birthday'];
//    $month = date('m', strtotime($user_birthday));
//    $month = array_sum(str_split($month));
//    $month = array_sum(str_split($month));
//    $day = date('d', strtotime($user_birthday));
//    $day = array_sum(str_split($day));
//    $day = array_sum(str_split($day));
//    $current_year = date('Y');
//    $current_year = array_sum(str_split($current_year));
//    $number_of_year = $current_year + $month + $day;
//    $number_of_year = array_sum(str_split($number_of_year));
//    $number_of_year = array_sum(str_split($number_of_year));
//
//    $number_of_year = NumberOfYear::where('number', $number_of_year)->first();
//    $number_of_year_contents = NumberOfYearContent::where('number_of_year_id', $number_of_year->id)->get()->toArray();
//
//    // 9 / Hai trang tĩnh cuối cùng 59 - 60
//    $content_static_lasts = Content::where('type', Content::TYPE_STATIC_LAST)->get()->toArray();
//
//    return view('frontends.users.report', [
//      'report' => $report,
//      'contents' => $contents,
//      'digit_content_arr' => $digit_content_arr,
//      'content_summaries' => $content_summaries,
//      'content_chart_birthday' => $content_chart_birthday,
//      'content_birthdays' => $content_birthdays,
//      'content_peak_template' => $content_peak_template,
//      'content_peaks' => $content_peaks,
//      'number_of_year_contents' => $number_of_year_contents,
//      'content_static_lasts' => $content_static_lasts,
//    ]);
//
//  }
//
//  public function listReport()
//  {
//    \Helper::$title_page = 'Danh sách báo cáo';
//    // Get report
//    $reports = Report::where('user_id', session()->get('user')->id)
//      ->orderBy('created_at', 'DESC')
//      ->paginate(20);
//    return view('frontends.users.report_list', [
//      'reports' => $reports,
//    ]);
//
//  }
//
//  public function printPdf($report_id)
//  {
//
//    \Helper::$title_page = 'In file PDF';
//    header('Content-Type: text/html; charset=utf-8');
//    $report = Report::findOrFail($report_id);
//    // Permisssion access report
//    if ($report->user_id != session()->get('user')->id) {
//      session()->put('error', 'Bạn không có quyền truy cập báo cáo này');
//      return redirect('/');
//    }
//
//    $pdf = App::make('dompdf.wrapper');
////      $pdf = PDF::loadView('test_pdf', []);
//    if ($pdf instanceof PDF) ;
////      return $pdf->download('invoice.pdf');
////      if ($pdf instanceof PDF)
////      dd($pdf);
//    // Get report
//    $contents = Content::orderBy('page_number', 'ASC')->get();
////    $view = view('frontends.users.report', [
////      'contents' => $contents,
////      'report' => $report,
////    ])->render();
//
//    $pdf->loadView('frontends.users.report', [
//      'contents' => $contents,
//      'report' => $report,
//    ]);
//
//    $path = storage_path() . "/pdf_$report_id.pdf";
//    $pdf->save($path, 'UTF-8');
////    return response()->download($path);
//    return $pdf->stream();
//    return $pdf->download('file.pdf');
////    dd($pdf);
//
//
////    $pdf->loadHTML($view)->setPaper('a4', 'landscape')
////      ->setWarnings(false)->save('myfile.pdf');
//////      $pdf->loadHTML($view);
//////
////    return $pdf->stream();
//  }


  public function profile()
  {
    return view('frontends.users.profile', ['user' => session()->get('user')]);
  }

  public function profileSave(Request $request)
  {
    $rules = [
      'email' => 'required|email',
      'password' => 'required|min:6',
      'password_confirm' => 'required|same:password',
    ];
    $messages = [
      'email.required' => 'Email không được để trống',
      'email.email' => 'Email chưa đúng định dạng',
      'password.required' => 'Password không được để trống',
      'password.min' => 'Password cần ít nhất 6 ký tự',
      'password_confirm.required' => 'Trường nhập lại mật khẩu không được để trống',
      'password_confirm.same' => 'Mật khẩu nhập lại chưa đúng',
    ];
    $request->validate($rules, $messages);
    $requests = $request->all();
    $requests['password'] = password_hash($request->get('password'), PASSWORD_DEFAULT);
//    $user = User::create($requests);

    $user = User::findOrFail(session()->get('user')->id);

    $is_update = $user->update($requests);

    if ($is_update) {
      // Set lại session user
      session()->put('user', $user);
      \session()->flash('success', "Cập nhật tài khoản thành công");
    } else {
      \session()->flash('error', "Cập nhật tài khoản thất bại");
    }
    return redirect('user/profile');
  }


}
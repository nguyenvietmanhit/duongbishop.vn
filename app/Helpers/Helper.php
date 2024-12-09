<?php

use App\Models\Ad;
use App\Models\AdGroup;

class Helper
{
    const COLUMNS = [
        1 => self::COLUMN_AD_NAME,
        2 => self::COLUMN_DAY,
        3 => self::COLUMN_DELIVERY_STATUS,
        4 => self::COLUMN_DELIVERY_LEVEL,
        5 => self::COLUMN_CAMPAIGN_NAME,
        6 => self::COLUMN_OBJECTIVE,
        7 => self::COLUMN_RESULT_TYPE,
        8 => self::COLUMN_RESULTS,
        9 => self::COLUMN_REACH,
        10 => self::COLUMN_IMPRESSIONS,
        11 => self::COLUMN_COST_PER_RESULT,
        12 => self::COLUMN_AMOUNT_SPENT_VND,
        13 => self::COLUMN_CLICKS_ALL,
        14 => self::COLUMN_CPC_ALL,
        15 => self::COLUMN_REPORTING_STARTS,
        16 => self::COLUMN_REPORTING_ENDS,
    ];
    const COLUMN_AD_NAME = 'Ad Name';
    const COLUMN_DAY = 'Day';
    const COLUMN_DELIVERY_STATUS = 'Delivery Status';
    const COLUMN_DELIVERY_LEVEL = 'Delivery Level';
    const COLUMN_AD_SET_NAME = 'Ad set name';
    const COLUMN_CAMPAIGN_NAME = 'Campaign Name';
    const COLUMN_OBJECTIVE = 'Objective';
    const COLUMN_RESULT_TYPE = 'Result Type';
    const COLUMN_RESULTS = 'Results';
    const COLUMN_REACH = 'Reach';
    const COLUMN_IMPRESSIONS = 'Impressions';
    const COLUMN_COST_PER_RESULT = 'Cost per Result';
    const COLUMN_AMOUNT_SPENT_VND = 'Amount Spent (VND)';
    const COLUMN_CLICKS_ALL = 'Clicks (All)';
    const COLUMN_CPC_ALL = 'CPC (All)';
    const COLUMN_REPORTING_STARTS = 'Reporting Starts';
    const COLUMN_REPORTING_ENDS = 'Reporting Ends';

    const STATUS_ACTIVE = 1;
    const STATUS_SOLD = 0;
    const STATUS_DISABLED = -1;

    const TYPE_CAMPAIGN = 'campaign';
    const TYPE_AD_GROUP = 'ad_group';
    const TYPE_AD = 'ad';
    const NGUYEN_AM = [
        'a' => 1,
        'e' => 5,
        'i' => 9,
        'o' => 6,
        'u' => 3,
        // 'y' => 6, nếu 2 ký tự liền kề là nguyên âm thì y là phụ âm và ngược lại
    ];
    const PHU_AM = [
        'b' => 2,
        'c' => 3,
        'd' => 4,
        'f' => 6,
        'g' => 7,
        'h' => 8,
        'j' => 1,
        'k' => 2,
        'l' => 3,
        'm' => 4,
        'n' => 5,
        'p' => 7,
        'q' => 8,
        'r' => 9,
        's' => 1,
        't' => 2,
        'v' => 4,
        'x' => 5,
//    'y' => 6, nếu 2 ký tự liền kề là nguyên âm thì y là phụ âm và ngược lại
        'z' => 7,

    ];

    const CHAR_BIRTHDAY_ROW_1 = [3, 6, 9];
    const CHAR_BIRTHDAY_ROW_2 = [2, 5, 8];
    const CHAR_BIRTHDAY_ROW_3 = [1, 4, 7];

    public static $url_print_pdf = '';
    public static $title_page = 'Dượng Bi Shop - Shop Acc Đột Kích';
    public static $seo_title = 'Dượng Bi Shop - Shop Acc Đột Kích';
    public static $seo_description = 'Dượng Bi Shop - Shop Acc Đột Kích';
    public static $seo_keyword = 'Dượng Bi Shop - Shop Acc Đột Kích';


    public static function getDateRange($strDateFrom, $strDateTo)
    {
        if (!$strDateFrom || !$strDateTo) {
            return [];
        }
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }


    /**
     * Lấy tên domain hiện tại dạng http://domain-name
     * @return string
     */
    public static function getDomain()
    {
        return url('/');
    }

    public static function getSeoTitle()
    {
        return self::$seo_title;
    }

    public static function getSeoDescription()
    {
        return self::$seo_description ;
    }

    public static function getSeoKeyword()
    {
        return self::$seo_keyword;
    }

    public static function getTitlePage()
    {
        return self::$title_page;
    }

    public static function getTokens($token)
    {
        $statistics = explode('||', $token);
        if (!$statistics) {
            return [];
        }

        return $statistics;
    }

    public static function convertStringToUnsigned($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    public static function getUrlFriendlyProduct($name, $id)
    {
        return 'chi-tiet-acc-' . self::convertStringToUnsigned($name) . "-$id.html";
    }

    public static function getUrlFriendlyNews($name, $id)
    {
        return 'tin-tuc/' . self::convertStringToUnsigned($name) . "-$id.html";
    }

    public static function getUrlFriendlyCategory($name, $id)
    {
        return 'danh-muc/' . self::convertStringToUnsigned($name) . "-$id.html";
    }

    public static function getStatusText($status)
    {
        $status_text = '';
        switch ($status) {
            case self::STATUS_ACTIVE:
                $status_text = 'Hiển thị';
                break;
            case self::STATUS_SOLD:
                $status_text = 'Acc đã bán';
                break;
            case self::STATUS_DISABLED:
                $status_text = 'Không hiển thị';
                break;
        }
        return $status_text;
    }

    public static function truncateStringByDot($string)
    {
        if (mb_strlen($string) > 80) {
            echo mb_substr($string, 0, 80) . "..";
        } else {
            echo $string;
        }
    }
}

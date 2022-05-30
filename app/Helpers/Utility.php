<?php



namespace App\Helpers;



use App\Models\QuestionPreferences;

use App\Models\Testimonial;
use Log;



class Utility

{



    public static $str = "Hello World!";

    private static $obj;



    private final function __construct()

    {

        echo __CLASS__ . " initialize only once ";

    }



    public static function getConnect()

    {

        if (!isset(self::$obj)) {





            $data = QuestionPreferences::select('key', 'question')->where('del_flag', 'N')->where('type', env('HIVE_PORTAL'))->get();

            $preferences = [];

            foreach ($data as $obj) {

                $preferences[$obj->key] = $obj->question;

            }

            self::$obj = $preferences;

        }



        return self::$obj;

    }



    public static function getQuestionByKey($str)

    {

        $preferences = Utility::getConnect();



        return isset($preferences[$str]) ? $preferences[$str] : '';

    }

    public static function convertYMDTimeToDMYTime($date)

    {



        return date('d-m-Y h:i A', strtotime($date));

    }

    public static function convertDMYTimeToYMDTime($date)

    {



        return date('Y-m-d H:i:s', strtotime($date));

    }

    public static function convertYMDT($date)

    {



        return date('Y-m-d', strtotime($date));

    }

    public static function convertTime($date)

    {



        return date('h:i A', strtotime($date));

    }

    public static function convert24HoursTime($date)

    {



        return date('H:i', strtotime($date));

    }

    public static function convertDateCharMonth($date)

    {



        return date('d F Y', strtotime($date));

    }

    public static function convertOnlyForFullMonthYear($date)

    {



        return date('F Y', strtotime($date));

    }

    public static function convertDMY($date)

    {



        return date('d-m-Y ', strtotime($date));

    }

    public static function time_elapsed_string($datetime, $full = false)

    {

        $now = new \DateTime();

        $ago = new \DateTime($datetime);

        $diff = $now->diff($ago);



        $diff->w = floor($diff->d / 7);

        $diff->d -= $diff->w * 7;



        $string = array(

            'y' => 'year',

            'm' => 'month',

            'w' => 'week',

            'd' => 'day',

            'h' => 'hour',

            'i' => 'minute',

            's' => 'second',

        );

        foreach ($string as $k => &$v) {

            if ($diff->$k) {



                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');

            } else {

                unset($string[$k]);

            }

        }



        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . '' : 'just now';

    }



    public static function notificationUnread()

    {

        $notificationCount =  auth()->user()->unreadNotifications->count();

        return $notificationCount;

    }



    public static function totalLeftHours($date)

    {

        $date = strtotime($date);

        $diff = $date - time();

        $days = floor($diff / (60 * 60 * 24)); //seconds/minute*minutes/hour*hours/day)

        $hours = round(($diff - $days * 60 * 60 * 24) / (60 * 60));



        return $hours;

    }



    public static function calculationTime($time)

    {

        $seconds = $time;

        return gmdate('H:i:s', $seconds);

    }

    public static function update($data, $where)

    {



        $update = QuestionPreferences::where($where)->where('type', env('HIVE_PORTAL'))->update($data);

        return $update;

    }

    public static function getAllTestimonialList(){
            $query = Testimonial::whereNull('deleted_at')->get();
            return $query;
    }
}


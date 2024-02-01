<?php

    use Carbon\Carbon;

    if (! function_exists('getTimezone')) {
        function getUserTimezone(){
            $timezone = auth()->user()->timezone;
            if(is_null($timezone)){
                $timezone = geoip()->getLocation()->timezone;
            }
            return $timezone;
        }
    }

    if (! function_exists('getDateFormat')) {
        function getDateFormat($show_time=true,$user=NULL ){
            if($show_time) $str_time = ' H:i:s';
            else $str_time = '';
            if(session('date_format')){
                $date_format = session('date_format').$str_time;
            } else {
                if($user){
                    $date_format = config('languages.lang.'.$user->language.'.date_format').$str_time;
                } else {
                    $date_format = 'd/m/Y'.$str_time;
                }
            }
            return $date_format;
        }
    }

    if (! function_exists('fromTime')) {
        function fromTime($time,$timezone=NULL,$date_format = NULL)
        {
            if(is_null($timezone)){
                $timezone = getUserTimezone();
            }
            if(is_null($date_format)){
                $date_format = getDateFormat();
            }
            return Carbon::createFromTimestamp($time)->setTimezone($timezone)->format($date_format);
        }
    }
    /*
    *FORMAT FROM *******Y-m-d H:i:s*********
    *
    */
    if (! function_exists('convertToLocal')) {
        function convertToLocal($time,$date_format=NULL,$timezone=NULL,$from_format='Y-m-d H:i:s')
        {
            if(is_null($timezone)){
                $timezone = getUserTimezone();
            }
            if(is_null($date_format)){
                $date_format = getDateFormat();
            }
            return Carbon::createFromFormat($from_format, $time, 'UTC')->setTimezone($timezone)->format($date_format);
        }
    }
    /*
    *FORMAT FROM *******Y-m-d*********
    *
    */
    if (! function_exists('formatDate')) {
        function formatDate($date,$date_format=NULL)
        {
            if(is_null($date_format)){
                $date_format = session('date_format');
            }
            return Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
        }
    }
    /*
    *FORMAT FROM  local to Y-m-d (DB format)
    *
    */
    if (! function_exists('LocalToDb')) {
        function LocalToDb($date)
        {
            return Carbon::createFromFormat(session('date_format'), $date)->format('Y-m-d');
        }
    }
    /*
    *FORMAT FROM  local to Y-m-d H:i:s (DB format)
    *
    */
    if (! function_exists('LocalDatetimeToDb')) {
        function LocalDatetimeToDb($date)
        {
            return Carbon::createFromFormat('d/m/Y H:i:s', $date)->format('Y-m-d H:i:s');
        }
    }

    /*
    *Add entity to date
    *
    */
    if (! function_exists('addToDate')) {
        function addToDate($um,$qt,$date_start=null)
        {
            if(!$date_start) $date = Carbon::now();
            else $date = Carbon::parse($date_start);

            switch($um){
                case "years":
                    $date->addYears($qt);
                break;
                case "months":
                    $date->addMonths($qt);
                break;
                case "days":
                    $date->addDays($qt);
                break;
            }

            return $date;
        }
    }
    /*
    *convert H:i:s in seconds
    *
    */
    if (! function_exists('toSeconds')) {
        function toSeconds($time)
        {
            $d = explode(':', $time);
            $seconds =  ($d[0] * 3600) + ($d[1] * 60) + $d[2];
            return $seconds;
        }
    }
    /*
    *check H:i:s format
    *
    */
    if (!function_exists('checkTimeFormat')) {
        function checkTimeFormat($time)
        {
            $str = '';
            $d = explode(':', $time);
            foreach($d as $k=>$v){
                $p = $v;
                if(strlen($v) == 1 ) $str.='0'.$v;
                else $str.=$v;
                if($k<2) $str.=':';
            }
            return $str;
        }
    }
    /*
    *format datetime without timezone (case of imported date)
    *
    */
    if (!function_exists('formatDateTime')) {
        function formatDateTime($datetime)
        {
            $format = \Carbon\Carbon::parse($datetime)->format(getDateFormat());
            return $format;
        }
    }
    /*
    *difference time between two dates
    *
    */
    if (!function_exists('timeTwoDates')) {
        function timeTwoDates($start, $end, $format_in='d/m/Y H:i:s')
        {
          $d1 = Carbon::createFromFormat($format_in, $start);
          $d2 = Carbon::createFromFormat('d/m/Y H:i:s', $end);
          $time = $d1->diff($d2)->format('%H:%I:%S');
          return $time;
        }
    }
    /*
    *difference time between two dates
    *
    */
    if (!function_exists('getMonths')) {
        function getMonths()
        {
          $months = [
            1 => 'Gennaio',
            2 => 'Febbraio',
            3 => 'Marzo',
            4 => 'Aprile',
            5 => 'Maggio',
            6 => 'Giugno',
            7 => 'Luglio',
            8 => 'Agosto',
            9 => 'Settembre',
            10 => 'Ottobre',
            11 => 'Novembre',
            12 => 'Dicembre',
          ];
          return $months;
        }
    }
    /*
    *
    */

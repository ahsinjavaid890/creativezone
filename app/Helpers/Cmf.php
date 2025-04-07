<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class Cmf
{
    public static function apiurl()
    {
        return 'http://localhost/creativezone/';
    }
    public static function adminstripAndLimit($text)
    {
        // Remove HTML tags
        $text = strip_tags($text);

        // Limit to 100 words
        $words = explode(' ', $text);
        if (count($words) > 4) {
            $text = implode(' ', array_slice($words, 0, 4)) . '...';
        }

        return $text;
    }
    public static function stripAndLimit($text)
    {
        // Remove HTML tags
        $text = strip_tags($text);

        // Limit to 100 words
        $words = explode(' ', $text);
        if (count($words) > 20) {
            $text = implode(' ', array_slice($words, 0, 20)) . '...';
        }

        return $text;
    }
    public static function numberFormat($number, $decimals=0)
    {
        if (strpos($number,'.')!=null)
        {
            $decimalNumbers = substr($number, strpos($number,'.'));
            $decimalNumbers = substr($decimalNumbers, 1, $decimals);
        }
        else
        {
            $decimalNumbers = 0;
            for ($i = 2; $i <=$decimals ; $i++)
            {
                $decimalNumbers = $decimalNumbers.'0';
            }
        }
        $number = (int) $number;
        $number = strrev($number);  // reverse

        $n = '';
        $stringlength = strlen($number);

        for ($i = 0; $i < $stringlength; $i++)
        {
            // from digit 3, every 2 digit () add comma
            if($i==2 || ($i>2 && $i%2==0) ) $n = $n.$number[$i].','; 
            else $n = $n.$number[$i];
        }

        $number = $n;    
        $number = strrev($number); // reverse

        ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;
        if ($number[0] == ',') $number = substr_replace($number, '', 0, 1);
        if ($number[1] == ',' && $number[0] == '-') $number = substr_replace($number, '', 1, 1);      

        return $number;
    }
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
    public static function sendimagetodirectory($imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        return $filename;
    }
    public static function storeimagefromurl($imageUrl)
    {
        $imageContents = file_get_contents($imageUrl);
        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        $filename = rand() . '.' . $extension;
        $filePath = public_path('images/' . $filename);
        file_put_contents($filePath, $imageContents);
        return $filename;
    }
    public static function shorten_url($text)
    {
        $words = explode('-', $text);
        $five_words = array_slice($words,0,12);
        $String_of_five_words = implode('-',$five_words)."\n";

        $String_of_five_words = preg_replace('~[^\pL\d]+~u', '-', $String_of_five_words);
        $String_of_five_words = iconv('utf-8', 'us-ascii//TRANSLIT', $String_of_five_words);
        $String_of_five_words = preg_replace('~[^-\w]+~', '', $String_of_five_words);
        $String_of_five_words = trim($String_of_five_words, '-');
        $String_of_five_words = preg_replace('~-+~', '-', $String_of_five_words);
        $String_of_five_words = strtolower($String_of_five_words);
        if (empty($String_of_five_words)) {
          return 'n-a';
        }
        return $String_of_five_words;
    }
    public static function create_time_ago($time)
    {

        $year = date('Y', strtotime($time));
        $month = date('m', strtotime($time));
        $day = date('d', strtotime($time));
        $datetime = Carbon::parse($time);
        return $datetime->diffForHumans();
    }
    public static function date_format($data)
    {
        if ($data instanceof \Illuminate\Support\Carbon) {
            return $data->format('d M Y H:i');
        }
        return \Illuminate\Support\Carbon::parse($data)->format('d M Y H:i');
    }
}
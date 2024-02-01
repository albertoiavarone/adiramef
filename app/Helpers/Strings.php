<?php

if (! function_exists('generateCode')) {
     function generateCode($length = 8, $table = NULL){
            $token = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet.= "0123456789";
            mt_srand(time());      // Call once. Good since $application_id is unique.
            for($i=0;$i<$length;$i++){
                $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
            }
            return $token;
        }
}

if (! function_exists('checkUniqueCode')) {
     function checkUniqueCode($model_name,$field_name,$length=8){
        do
        {
            $code = generateCode($length);
            $check_code = $model_name::where($field_name, $code)->first();
        }
        while(!empty($check_code));
        return $code;
    }
}

if (! function_exists('toLocalPrice')) {
     function toLocalPrice($amount,$toString=true){
        $locale = config('languages.lang.'.session('locale'));
        $price = number_format(floatval($amount),
            $locale['decimal'],
            $locale['decimal_separator'],
            $locale['thousand_separator']
        );
        if($toString){
            return $locale['currency_symbol'].' '.$price;
        } else {
            return $price;
        }
    }
}
/*
*
*
*/
if (! function_exists('loremIpsum')) {
     function loremIpsum($class='',$p=1){
         $block = '<p class="'.$class.'">Lorem ipsum dolor sit amet, consectetuer adipiscing
                     elit. Aenean commodo ligula eget dolor. Donec quam felis,
                     ultricies nec, pellentesque eu, pretium quis, sem.</p>';
        $text = '';
        for($i=0;$i<$p;$i++){
            $text.=$block;
        }
        return $text;
    }
}
/*
*
*
*
*/
if (! function_exists('xmlToArray')) {
     function xmlToArray($response, $path='//soapBody'){
        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = new SimpleXMLElement($response);
        $body =  $xml->xpath($path)[0];
        $array = json_decode(json_encode($body), true);
        return $array;
    }
}
/*
*
*
*
*/
if (! function_exists('getFlag')) {
     function getFlag($code){
         $flag_html = '<span class="symbol symbol-20 mr-3">
                         <img src="'.asset('assets/media/svg/flags/'.$code.'.svg').'" alt="" />
                      </span>';
        return $flag_html;
    }
}
/*
*
*/
if (! function_exists('getPriority')) {
     function getPriority(){
        $array = [];
        for($i=1;$i<=3;$i++){
            $array[$i] = __('general.priority_'.$i);
        }
        return $array;
    }
}
/*
*
*/
if (! function_exists('collectionToArray')) {
     function collectionToArray($collection,$key,$value){
        $array = [];
        foreach($collection as $row){
            $array[$row->$key] = $row->$value;
        }
        return $array;
    }
}
/*
*
*/
if (!function_exists('getLinkUserImage')) {
     function getLinkUserImage($user){
         if(is_null($user->image)){
            $link = asset('assets/media/users/blank.png');
         } else {
             $link = Storage::disk(config('values.FILESYSTEM_DRIVER'))->url($user->image);
         }
        return $link;
    }
}
/*
*
*/
if (!function_exists('string_between_two_string')) {
    function string_between_two_string($str, $starting_word, $ending_word) {
     $subtring_start = strpos($str, $starting_word);
     //Adding the strating index of the strating word to
     //its length would give its ending index
     $subtring_start += strlen($starting_word);
     //Length of our required sub string
     $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
     // Return the substring from the index substring_start of length size
     return substr($str, $subtring_start, $size);
    }
}
/*
*
*
*/
if (!function_exists('getAddress')) {
    function getAddress($latitude, $longitude){
      $url = 'https://api.bsqcontrol.it/getFormattedAddressV1.php?lat='.$latitude.'&lng='.$longitude;
      $response = Http::get($url);
      return $response['a'];
    }
}
/*
*
*/
if (!function_exists('selectTabView')) {
  function selectTabView($id_tab_active) {
    session()->flash('id_tab_active', $id_tab_active);
    return;
  }
}
/*
*
*/
if (!function_exists('echoArray')) {
  function echoArray($arr) {
    echo '<ul>';
    foreach($arr as $key=>$value){
        echo '<li><strong>'.$key . ":</strong>&nbsp;&nbsp;";
        if (is_array($value)) {
            echoArray($value);
        } else {
            echo $value . "</li>";
        }
    }
    echo '</ul>';
  }
}
/*
*
*/
if (!function_exists('echoArrayLabelLang')) {
  function echoArrayLabelLang($arr,$lang) {
    echo '<ul>';
    foreach($arr as $key=>$value){
        echo '<li><strong>'.(__($lang.'.'.$key)). ":</strong>&nbsp;&nbsp;";
        if (is_array($value)) {
            echoArray($value);
        } else {
            echo $value . "</li>";
        }
    }
    echo '</ul>';
  }
}
/*
*
*/

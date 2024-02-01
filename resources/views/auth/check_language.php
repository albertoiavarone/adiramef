<?php


    $arr_ip = geoip()->getLocation();
    if(!session('locale')){
        if( array_key_exists ( strtolower( $arr_ip->iso_code ) , config('languages.lang') ) ){
            session()->put('locale',strtolower($arr_ip->iso_code));
        }
    }
    /*
    $debug = 0;
    if($debug==1){
        if(!session('locale')){

                echo '<p>Nessuna scelta esplicita...</p>';
                echo '<p>Ti stai collegando da: '.$arr_ip->country.' </p>';
                echo '<p>Elenco lingue presenti...</p>';
                dump(config('languages.lang'));
                echo '<p>Verifico se esiste la lingua '.strtolower( $arr_ip->iso_code ).'</p>';
                dump( array_key_exists ( strtolower( $arr_ip->iso_code ) , config('languages.lang') ));
            if( array_key_exists ( strtolower( $arr_ip->iso_code ) , config('languages.lang') ) ){
                echo '<p>Trovata '.config('languages.lang')[strtolower($arr_ip->iso_code)]['name'].' -> default!!</p>';
            } else {
                echo '<p>Lingua non trovata verra settata quella di default...'.app()->getLocale().'</p>';
            }
        } else {
            echo '<p>Session già settata... <strong>'.session('locale').'</strong></p>';
        }
        echo '<h3>Locale: '.session('locale').'</h3>';
    }
    */

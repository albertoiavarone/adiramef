<?php

namespace App\Classes;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ShortUrls{

    public function generateUrl($destination, $options=[]){

        if(isset($options['singleUse'])){
            $singleUse = $options['singleUse'];
        } else $singleUse = false;

        if(isset($options['trackVisits'])){
            $trackVisits = $options['trackVisits'];
        } else $trackVisits = true;

        if(isset($options['secure'])){
            $secure = $options['secure'];
        } else $secure = true;

        if(isset($options['activateAt']) && $options['activateAt']>0){
            $activateAt = \Carbon\Carbon::now()->addDay($options['activateAt']);
        } else $activateAt = \Carbon\Carbon::now()->addSeconds(10);

        if(isset($options['deactivateAt']) && $options['deactivateAt']>0){
            $deactivateAt = \Carbon\Carbon::now()->addDay($options['deactivateAt']);
        } else $deactivateAt = \Carbon\Carbon::now()->addDay(365);

        if($trackVisits){

            if(isset($options['trackIPAddres'])){
                $trackIPAddres = $options['trackIPAddres'];
            } else $trackIPAddres = true;

            if(isset($options['trackBrowser'])){
                $trackBrowser = $options['trackBrowser'];
            } else $trackBrowser = true;

            if(isset($options['trackBrowserVersion'])){
                $trackBrowserVersion = $options['trackBrowserVersion'];
            } else $trackBrowserVersion = true;

            if(isset($options['trackOperatingSystem'])){
                $trackOperatingSystem = $options['trackOperatingSystem'];
            } else $trackOperatingSystem = true;

            if(isset($options['trackOperatingSystemVersion'])){
                $trackOperatingSystemVersion = $options['trackOperatingSystemVersion'];
            } else $trackOperatingSystemVersion = true;

            if(isset($options['trackDeviceType'])){
                $trackDeviceType = $options['trackDeviceType'];
            } else $trackDeviceType = true;

            if(isset($options['trackRefererURL'])){
                $trackRefererURL = $options['trackRefererURL'];
            } else $trackRefererURL = true;

        } else {

            $trackIPAddres = false;
            $trackBrowser = false;
            $trackBrowserVersion = false;
            $trackOperatingSystem = false;
            $trackOperatingSystemVersion = false;
            $trackDeviceType = false;
            $trackRefererURL = false;
        }

        $builder = new \AshAllenDesign\ShortURL\Classes\Builder();
        $shortURLObject = $builder->destinationUrl($destination)
                            ->singleUse($singleUse)
                            ->secure($secure)
                            ->trackVisits($trackVisits)
                            ->trackIPAddress($trackIPAddres)
                            ->trackBrowser($trackBrowser)
                            ->trackBrowserVersion($trackBrowserVersion)
                            ->trackOperatingSystem($trackOperatingSystem)
                            ->trackOperatingSystemVersion($trackOperatingSystemVersion)
                            ->trackDeviceType($trackDeviceType)
                            ->trackRefererURL($trackRefererURL)
                            ->activateAt($activateAt)
                            ->deactivateAt($deactivateAt)
                            ->make();
        $shortURL = $shortURLObject->default_short_url;
        return $shortURL;
    }
    /*
    *
    *
    */
}

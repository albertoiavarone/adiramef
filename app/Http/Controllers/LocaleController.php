<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function locale($locale){
        session()->put('locale',$locale);
        session()->put('date_format' , config('languages.lang.'.$locale.'.date_format'));
        return redirect()->back();
    }


}

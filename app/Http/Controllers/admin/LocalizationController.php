<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLang($locale){
        App::setLocale($locale);
        Session::put("locale",$locale);
        return redirect()->back();
    }
    
}
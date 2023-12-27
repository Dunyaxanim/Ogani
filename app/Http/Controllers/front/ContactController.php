<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Map;

class ContactController extends Controller
{
    public function index()
    {
        $general = General::get()->first();
        $map = Map::get()->first();
        return view('front.pages.contact',["general"=>$general,'map'=>$map]);
    }
}
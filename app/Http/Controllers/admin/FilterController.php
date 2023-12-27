<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getdata(Request $request)
    {
        $data = $request->input('query');
        return view('front.pages.filterProduct',compact('data'));
    }
    
}



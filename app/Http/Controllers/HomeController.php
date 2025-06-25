<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slides;

class HomeController extends Controller
{
        public function index()
    {
        $slides = Slides::where('status',1)->get()->take(3);
        return view('shopindex',compact('slides'));
    }
}

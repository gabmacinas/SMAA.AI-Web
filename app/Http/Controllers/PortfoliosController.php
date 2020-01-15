<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfoliosController extends Controller
{
    public function index()
    {
    	return view('portfolio.index')->with('title','My Portfolio - SMAA.AI');
    }
}

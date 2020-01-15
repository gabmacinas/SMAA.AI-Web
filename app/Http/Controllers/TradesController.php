<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Form;
use Html;
use Auth;

class TradesController extends Controller
{
    public function index()
    {
        $title = 'SMAAA.AI - Trading';
        $user = Auth::user();
        if ( $user->api_key == '-')
        {
            $user->api_key = 'PKUK3R1EK699RTZ5FEQS';
            $user->api_secret_key = 'SJiiwN43mUI91buDaG0Hqt25iPc0nqy1QGHtDfl6';
            session()->flash('newConfig',"Warning: Please configure your API's in the API Settings in order to use the full functionality of Stock Market Advanced Analysis - Artifical Intelligence.");
        }
        $order_history = app(PythonController::class)->callCommand('orderhistory',$user);
        $portfolio = app(PythonController::class)->callCommand('portfolio',$user);
        return view('trading.index')->with(compact('title','order_history', 'portfolio'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $b_method = strtolower($request->input('b_method'));
        $ticker = strtoupper($request->input('ticker'));
        $shares = $request->input('shares');
        $trade = app(PythonController::class)->manualTrade($user,$b_method,$ticker,$shares);
        return redirect('trading');
    }
}
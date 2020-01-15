<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Form;
use Html;
use Auth;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $user = Auth::user();
        if ( $user->api_key == '-')
        {
            $user->api_key = 'PKUK3R1EK699RTZ5FEQS';
            $user->api_secret_key = 'SJiiwN43mUI91buDaG0Hqt25iPc0nqy1QGHtDfl6';
            session()->flash('newConfig',"Warning: Please configure your API's in the API Settings in order to use the full functionality of Stock Market Advanced Analysis - Artifical Intelligence.");
            //add user warning to modify in order to trade since the data was set to default
        }

        $account = app(PythonController::class)->callCommand('getaccountinfo',$user);
        $order_history = app(PythonController::class)->callCommand('orderhistory',$user);
        $portfolio = app(PythonController::class)->callCommand('portfolio',$user);
        return view('dashboard.index')->with(compact('account', 'order_history', 'portfolio'));
        
    }

}
    
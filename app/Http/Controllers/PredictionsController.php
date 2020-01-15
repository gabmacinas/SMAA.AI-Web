<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Form;
use Html;

class PredictionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get user order history
        $process = new Process("python C:\\gab\\alpaca_algo_test\\f_orderhistory.py");
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        $newstring = preg_replace("/[\r\n]/","",$data);
        $order_history = json_decode($newstring,true); 
       
        //get user portfolio
        $process = new Process("python C:\\gab\\alpaca_algo_test\\f_portfolio.py");
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        $newstring = preg_replace("/[\r\n]/","",$data);
        $portfolio = json_decode($newstring,true); 


        //commented for testing viewsx
        // $process = new Process("python C:\Users\USER\Documents\Smaa.ai\RNN\sysargs.py Z2VJZBQEVYJC10SE TSLA");
        // $process->setTimeout(2 * 3600);
        // $process->run();
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // $data = $process->getOutput();
        // $newstring = preg_replace("/[\r\n]/","",$data);
        // $predictedData = json_decode($newstring,true); 
        $predictedData = json_decode('{"0":{"0":64.7399139404,"1":64.8192520142,"2":65.1078262329,"3":65.6936340332,"4":66.6260147095,"5":67.9170379639,"6":69.5498504639,"7":71.4852142334,"8":73.6682662964,"9":76.0349807739,"10":78.5198287964,"11":81.0625762939,"12":83.6106414795,"13":86.1201400757,"14":88.5536956787,"15":90.8753585815,"16":93.0580596924,"17":95.0804748535,"18":96.9345855713,"19":98.6221923828}}',true);

        $newData = $predictedData[0]; 
        $DataCount = count($newData);
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'])
        ->datasets([
            [
                "label" => "Predicted Data",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $newData,
            ]
        ])
        ->options([]);
        
        



        return view('prediction.index')->with(compact('order_history', 'portfolio','chartjs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

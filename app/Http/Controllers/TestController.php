<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Form;
use Html;

class TestController extends Controller
{
    public function index()
    {
        $title = 'Testing';

        $predictedData = json_decode('{"0":{"0":64.7399139404,"1":64.8192520142,"2":65.1078262329,"3":65.6936340332,"4":66.6260147095,"5":67.9170379639,"6":69.5498504639,"7":71.4852142334,"8":73.6682662964,"9":76.0349807739,"10":78.5198287964,"11":81.0625762939,"12":83.6106414795,"13":86.1201400757,"14":88.5536956787,"15":90.8753585815,"16":93.0580596924,"17":95.0804748535,"18":96.9345855713,"19":98.6221923828}}',true);

        $newData = $predictedData[0]; 
        $DataCount = count($newData);
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
        ->datasets([
            [
                "label" => "My First dataset",
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
        return view('test.index')->with(compact('title','chartjs'));
    }
}

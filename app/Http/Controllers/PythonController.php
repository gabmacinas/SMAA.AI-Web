<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;

class PythonController extends Controller
{
    
   	private function getSrcPath()
   	{
      return "/home/smaaai/ftp/alpaca_algo_test/";
   	}

    private function getPythonLocationPath()
    {
      return "/root/anaconda3/bin/python";
    }

    public function callCommand($command_name = '',$user)
    {
      try
      {
        $command = $this->getPythonLocationPath()." ".$this->getSrcPath()."f_".$command_name.".py ".$user->api_key." ".$user->api_secret_key." ".$user->api_endpoint;
        $process = new Process($command);
        $process->setTimeout(2 * 3600);
        $process->run();
        if (!$process->isSuccessful()) 
        {
          throw new ProcessFailedException($process);
        }
          $data = $process->getOutput();
          $newstring = preg_replace("/[\n\r]/","",$data);

        return json_decode($newstring, true); 
      }
      catch(Exception $e)
      {
        dd('an error has occured in the backend side. Please contact the administrator');
      }
    }

    public function autoTrade()
    {
      return null;
    }

    public function manualTrade($user, $b_method, $ticker, $shares)
    {
      try
      {
        $command = $this->getPythonLocationPath()." ".$this->getSrcPath()."f_trade.py ".$user->api_key." ".$user->api_secret_key." ".$user->api_endpoint." ".$b_method." ".$ticker." ".$shares;
        $process = new Process($command);
        $process->setTimeout(2 * 3600);
        $process->run();
        if (!$process->isSuccessful()) 
        {
          throw new ProcessFailedException($process);
        }
          $data = $process->getOutput();
          $newstring = preg_replace("/[\n\r]/","",$data);

        return json_decode($newstring, true); 
      }
      catch(Exception $e)
      {
        dd('an error has occured in the backend side. Please contact the administrator');
      }
    }

    public function predictPrice()
    {
      return null;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PythonController extends Controller
{

    public function runPythonGlcm($image_path = null)
    {
        $scriptFile = public_path('python/glcm.py');
        $pythonExecutable = env('PYTHON_EXECUTABLE', 'python'); // Get the Python executable from env or default to 'python'
        $file_path = $image_path;

        try {
            $process = new Process([$pythonExecutable, $scriptFile, $file_path]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            return Response::json(['message' => 'Script executed successfully', 'output' => $output]);
        } catch (ProcessFailedException $exception) {
            // Handle the process failure
            return Response::json([
                'message' => 'Script execution failed',
                'error' => $exception->getMessage(),
            ], 500); // Replace 500 with appropriate HTTP status code
        }
    }
    public function runPythonScripts($image_path = null)
    {
        $scriptFile = public_path('python/main.py');
        $pythonExecutable = env('PYTHON_EXECUTABLE', 'python'); // Get the Python executable from env or default to 'python'
        $file_path = $image_path;

        try {
            $process = new Process([$pythonExecutable, $scriptFile, $file_path]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            return Response::json(['message' => 'Script executed successfully', 'output' => $output]);
        } catch (ProcessFailedException $exception) {
            // Handle the process failure
            return Response::json([
                'message' => 'Script execution failed',
                'error' => $exception->getMessage(),
            ], 500); // Replace 500 with appropriate HTTP status code
        }
    }
}

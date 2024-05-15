<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Response; // Assuming you're using Laravel's Facades

class PythonController extends Controller
{
    public function runPythonScript()
    {
        $scriptFile = public_path('python/main.py');

        try {
            $process = new Process(['python', $scriptFile]);
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

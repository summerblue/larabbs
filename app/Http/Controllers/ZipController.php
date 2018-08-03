<?php

namespace App\Http\Controllers;

use File;
use Zipper;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function index()
    {
        $logs = File::files(storage_path('logs'));

        return view('zip', compact('logs'));
    }

    public function download(Request $request)
    {
        $name = 'logs-'.time().'.zip';
        $zipper = Zipper::make($name)->folder('logs');

        foreach ($request->logs as $log) {
            $path = storage_path('logs/'.basename($log));

            if (! File::exists($path)) {
                continue;
            }

            $zipper->add($path);
        }

        $zipper->close();

        return response()->download(public_path($name))->deleteFileAfterSend(true);
    }

    public function upload(Request $request)
    {
        if ($request->logs) {
            $zipper = Zipper::make($request->logs);

            logger('zip file list:');
            logger($zipper->listFiles());

            $zipper->folder('logs')->extractMatchingRegex(storage_path('logs'), '/\.log$/');
        }

        return redirect()->route('zip.index');
    }
}

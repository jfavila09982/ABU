<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PollingController extends Controller
{
    
    public function poll()
    {
        // Set a timeout period
        $timeout = 30; // seconds

        $start = time();
        while ((time() - $start) < $timeout) {
            $data = Cache::get('data', 'Initial data');

            if ($data !== 'Initial data') {
                return response()->json(['data' => $data]);
            }

            sleep(1); // Wait for 1 second before checking again
        }

        return response()->json(['data' => 'Initial data']);
    }

    public function update(Request $request)
    {
        // Validate and update the data
        $request->validate([
            'data' => 'required|string',
        ]);

        Cache::put('data', $request->input('data'));

        return response()->json(['status' => 'success']);
    }


}

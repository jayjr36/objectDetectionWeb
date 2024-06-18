<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function index()
    {
        return SensorData::orderBy('created_at', 'desc')->take(50)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sensor_id' => 'required|string',
            'detection_level' => 'required|numeric',
        ]);

        $detectionData = SensorData::create($data);

        return response()->json($detectionData, 201);
    }

}

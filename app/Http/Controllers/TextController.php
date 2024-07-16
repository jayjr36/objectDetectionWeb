<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
use Illuminate\Support\Facades\Http;

class TextController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Text::create([
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'Message stored successfully'], 201);
    }

    public function showGraph()
    {
        $texts = Text::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                      ->groupBy('date')
                      ->get();

        return view('displaypage', compact('texts'));
    }

    public function updateGraph()
{
    $texts = Text::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                  ->groupBy('date')
                  ->get();

    return response()->json($texts);
}

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomController extends Controller
{
    public function generateRandomNumbers()
    {
        $numbers = range(1, 10);
        shuffle($numbers);
        $randomNumbers = array_slice($numbers, 0, 1); // Faqat 5 ta tasodifiy son
        
        return response()->json([
            'numbers' => implode(" ", $randomNumbers),
            'numbers_array' => $randomNumbers
        ]);
    }
    // app/Http/Controllers/RandomController.php
public function showRandomView()
{
    return view('random');
}
}
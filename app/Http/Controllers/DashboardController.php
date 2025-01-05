<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Exemplo de dados fictícios dos últimos 7 dias
        $data = collect([
            ['date' => Carbon::today()->subDays(6), 'views' => 150],
            ['date' => Carbon::today()->subDays(5), 'views' => 200],
            ['date' => Carbon::today()->subDays(4), 'views' => 180],
            ['date' => Carbon::today()->subDays(3), 'views' => 220],
            ['date' => Carbon::today()->subDays(2), 'views' => 240],
            ['date' => Carbon::today()->subDay(), 'views' => 300],
            ['date' => Carbon::today(), 'views' => 400],
        ]);

        $chartData = [
            'labels' => $data->pluck('date')->map(fn($date) => $date->format('d/m'))->toArray(),
            'data' => $data->pluck('views')->toArray(),
        ];

        return view('dashboard', compact('chartData'));
    }
}

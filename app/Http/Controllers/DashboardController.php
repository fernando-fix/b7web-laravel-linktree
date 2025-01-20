<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::today();

        if ($request->date) {
            $date = Carbon::parse($request->date);
        }

        $data = [
            ['date' => $date->copy()->subDays(6)],
            ['date' => $date->copy()->subDays(5)],
            ['date' => $date->copy()->subDays(4)],
            ['date' => $date->copy()->subDays(3)],
            ['date' => $date->copy()->subDays(2)],
            ['date' => $date->copy()->subDays(1)],
            ['date' => $date->copy()->subDays(0)],
        ];

        foreach ($data as $key => $value) {
            $data[$key]['views'] = View::whereDate('date', $value['date']->format('Y-m-d'))->count();
        }

        $chartData = [
            'labels' => collect($data)->pluck('date')->map(fn($date) => $date->format('d/m'))->toArray(),
            'data' => collect($data)->pluck('views')->toArray(),
        ];

        $user = User::find(Auth::user()->id);
        $links = $user->links()->orderByDesc(
            FacadesDB::raw('(
                SELECT COUNT(*) FROM clicks
                WHERE clicks.link_id = links.id
            )')
        )->get();

        return view('dashboard', compact('chartData', 'user', 'links'));
    }
}

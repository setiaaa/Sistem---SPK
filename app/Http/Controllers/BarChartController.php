<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK; 
use Illuminate\Support\Facades\DB;

class BarChartController extends Controller
{
    public function getData()
    {
        $spk = DB::table('spk')
                ->select(
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->get();
        $labels = json_encode($spk->pluck('month'));
        $count = json_encode($spk->pluck('count'));

        return (compact('labels', 'count'));
    }

}

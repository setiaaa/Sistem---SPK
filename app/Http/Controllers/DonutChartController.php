<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use Illuminate\Support\Facades\DB;

class DonutChartController extends Controller
{
    public function getData()
    {
        $spk = DB::table('spk')
                ->select(
                DB::raw('status'),
                DB::raw('COUNT(*) as count')
                )
                ->whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', date('m'))
                ->groupBy('status')
                ->get();
        
        $status = json_encode($spk->pluck('status'));
        $count = json_encode($spk->pluck('count'));

        return (compact('status', 'count'));
    }
}

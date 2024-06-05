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
                // ->whereMonth('tanggal', date('m'))
                ->OrderBy(
                    DB::raw('CASE 
                        WHEN status = "Todo" THEN 1
                        WHEN status = "Running" THEN 2
                        WHEN Status = "Done" THEN 3
                        END')
                )->groupBy('status')
                ->get();
        $status = $spk->pluck('status');
        $count = $spk->pluck('count');
        $colors = ['#FFD623', '#3AC441', '#5889F4'];
        $hovers = ['#B79211', '#1D8D36', '#2C4DAF'];

        return (compact('status', 'count', 'colors', 'hovers'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarChartController extends Controller
{
    public function getData()
    {
        $spk = 
        DB::table('spk')
                ->selectRaw('MONTHNAME(tanggal) AS month, COUNT(*) AS count')
                ->groupBy('month')
                ->orderBy(
                    DB::raw('CASE 
                        WHEN month = "January" THEN 1
                        WHEN month = "February" THEN 2
                        WHEN month = "March" THEN 3
                        When month = "April" THEN 4
                        WHEN month = "May" THEN 5
                        WHEN month = "June" THEN 6
                        WHEN month = "July" THEN 7
                        WHEN month = "August" THEN 8
                        WHEN month = "September" THEN 9
                        WHEN month = "October" THEN 10
                        WHEN month = "November" THEN 11
                        WHEN month = "December" THEN 12
                        END')
                )
                ->get();

                

        $labels = $spk->pluck('month');
        $count = $spk->pluck('count');

        return (compact('labels', 'count'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function getData()
    {
        $spk['spk'] = DB::table('spk')
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
        return $spk['spk'];
    }
}

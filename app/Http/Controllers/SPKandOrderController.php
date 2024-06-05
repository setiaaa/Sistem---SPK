<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChartController;
use App\Charts\SPKChart;
use App\Http\Controllers\BarChartController;
use App\Http\Controllers\DonutChartController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CardController;

class SPKandOrderController extends Controller
{
    public function index()
    {
        // Buat instance dari SPKController dan panggil metode index
        $controllerSPK = new SPKController();
        $spkMesinResult = $controllerSPK->indexSPKMesin();
        $spkNotaResult = $controllerSPK->indexSPKNota();

        // Buat instance dari OrderController dan panggil metode spk
        $controllerOrder = new OrderController();
        $orderResult = $controllerOrder->spk();

        // Buat instance dari CardController dan panggil metode getData()
        $cards = new CardController();
        $card = $cards->getData();

        // Buat instance dari ChartController dan panggil metode getData()
        $barChartController = new BarChartController();
        $barChart = $barChartController->getData();
        $donutChartController = new DonutChartController();
        $donutChart = $donutChartController->getData();

        return view('contents.dashboard', [
            'card' => $card,
            'dataSPKMesin' => $spkMesinResult,
            'dataSPKNota' => $spkNotaResult,
            'odr' => $orderResult,
            'barlabels' => $barChart['labels'],
            'barcount' => $barChart['count'],
            'donutstatus' => $donutChart['status'],
            'donutcount' => $donutChart['count'],
            'donutcolors' => $donutChart['colors'],
            'donuthovers' => $donutChart['hovers']
        ]);
    }

}

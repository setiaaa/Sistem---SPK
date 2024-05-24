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

class SPKandOrderController extends Controller
{
    public function index()
    {
        // Buat instance dari SPKController dan panggil metode index
        $controllerSPK = new SPKController();
        $spkResult = $controllerSPK->index();

        // Buat instance dari OrderController dan panggil metode spk
        $controllerOrder = new OrderController();
        $orderResult = $controllerOrder->spk();

        // Buat instance dari ChartController dan panggil metode getData()
        $barChartController = new BarChartController();
        $barChart = $barChartController->getData();
        $donutChartController = new DonutChartController();
        $donutChart = $donutChartController->getData();

        return view('contents.dashboard', [
            'data' => $spkResult,
            'odr' => $orderResult,
            'barlabels' => $barChart['labels'],
            'barcount' => $barChart['count'],
            'donutstatus' => $donutChart['status'],
            'donutcount' => $donutChart['count']
        ]);
    }

}

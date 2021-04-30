<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;

class FetchChartDataController extends Controller
{
    public function fetchOrderByProvince() {
        $data = Province::select('type' , 'order_count')->get();
        //fix vietnamese to json issues
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}

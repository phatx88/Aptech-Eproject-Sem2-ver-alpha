<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class FetchChartDataController extends Controller
{
    public function fetchOrderByProvince() {
        $data = DB::table('province')->select('type' , 'order_count')->get();
        //fix vietnamese to json issues
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function fetchSalesPerProduct() {
        $data = DB::table('top_seller_product')->select('product_id','price', 'inventory', 'total_qty', 'total_sales')->get();
        //fix vietnamese to json issues
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}

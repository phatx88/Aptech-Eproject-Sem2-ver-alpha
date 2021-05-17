<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor;
use App\Models\OrderItem;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Admin_DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // APEX CHART MOST ACTIVE USERS
        $usersRange = Visitor::selectRaw('Sum(hits) , user_id')->whereNotNull('user_id')->groupBy('user_id')->orderBy('Sum(hits)' , 'DESC')->pluck('user_id')->take(10)->toArray();
        $usershits = Visitor::selectRaw('Sum(hits) , user_id')->whereIn('user_id', $usersRange)->groupBy('user_id')->orderBy('user_id' , 'ASC')->pluck('Sum(hits)')->toArray();
        $usernames = User::whereIn('id' , $usersRange)->orderBy('id' , 'ASC')->pluck('name' , 'id')->toArray();
        $usernames = parameterize_array($usernames);
        // dd ($usershits);
        $usersChart = (new LarapexChart)->radarChart()
            ->setTitle('Most Active Users.')
            ->setSubtitle('Total # of Hits.')
            ->addData('Hits', $usershits)
            ->setXAxis($usernames)
            ->setColors(['#FFC107'])
            ->setMarkers(['#ff455f'], 5, 10);

        // APEX CHART MOST VISITED BY DATE
        $dateRange = Visitor::distinct('date_visited')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->pluck('date_visited')->toArray();
        $nonRegHits = Visitor::selectRaw('date_visited, Sum(hits)')->groupBy('date_visited')->whereNull('user_id')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->pluck('Sum(hits)')->toArray();
        $RegHits = Visitor::selectRaw('date_visited, Sum(hits)')->groupBy('date_visited')->whereNotNull('user_id')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->pluck('Sum(hits)')->toArray();
        $visitChart = (new LarapexChart)->barChart()
            ->setTitle('Visitors by Date.')
            ->setSubtitle('Hits during last 7 days.')
            ->addData('Non-registered', $nonRegHits)
            ->addData('Registered', $RegHits)
            ->setXAxis($dateRange);

        // APEX CHART SALE FIGURES 
        $lastYear = DB::table('total_sales_per_month')
        ->where('year(created_date)', now()->year - 1)
        ->whereBetween('month(created_date)', [1,12])
        ->pluck('total_sales')
        ->toArray();

        $thisYear = DB::table('total_sales_per_month')
        ->where('year(created_date)', now()->year)
        ->whereBetween('month(created_date)', [1,12])
        ->pluck('total_sales')
        ->toArray();
        
        $saleChart = (new LarapexChart)->areaChart()
        ->setTitle('Sales Figures (in $).')
        ->setSubtitle('This Year Sales vs Last Year Sales.')
        ->addData('This Year Sales', $thisYear)
        ->addData('Last Year Sales', $lastYear)
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
        ->setGrid(false, '#303F9F', 0.1)
        ->setColors(['#FFC107', '#303F9F'])
        ->setMarkers(['#FF5722', '#303FFF'], 5, 10);

        // APEX CHART Order FIGURES by Months 
        $lastYearOrder = DB::table('total_sales_per_month')
        ->where('year(created_date)', now()->year - 1)
        ->whereBetween('month(created_date)', [1,12])
        ->pluck('total_orders')
        ->toArray();

        $thisYearOrder = DB::table('total_sales_per_month')
        ->where('year(created_date)', now()->year)
        ->whereBetween('month(created_date)', [1,12])
        ->pluck('total_orders')
        ->toArray();

        $orderbar = (new LarapexChart)->horizontalBarChart()
            ->setTitle('Monthly Orders.')
            ->setSubtitle('This Year Orders vs Last Year Orders.')
            ->addData('This Year Orders', $thisYearOrder)
            ->addData('Last Year Orders', $lastYearOrder)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->setColors(['#FFC107', '#303F9F']);

        $salebar = (new LarapexChart)->horizontalBarChart()
        ->setTitle('Monthly Sales.')
        ->setSubtitle('This Year Sales vs Last Year Sales.')
        ->addData('This Year Sales', $thisYear)
        ->addData('Last Year Sales', $lastYear)
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
        ->setColors(['#FF5722', '#303F9F']);

        $products = Product::select('id' , 'name', 'featured_image', 'price' , 'inventory_qty', 'sale_price')->get();
        $orders = DB::table('total_per_order')->orderBy('order_id' , 'DESC')->limit(100)->get();
        $totalOrder = Order::count();
        $totalSales = DB::table('total_per_order')->sum('total');
        
        return view('admin.dashboard', [
            'usersChart' => $usersChart,
            'visitChart' => $visitChart,
            'saleChart' => $saleChart,
            'orderbar' => $orderbar,
            'salebar' => $salebar,
            'orders' => $orders,
            'products' => $products,
            'totalOrder' => $totalOrder,
            'totalSales' => $totalSales
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Visitor;
use App\Models\OrderItem;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class Admin_DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::orderby('id' , 'DESC')->get();
        $orderItems = OrderItem::get();

        // APEX CHART MOST ACTIVE USERS 
        $usersRange = Visitor::distinct('user_id')->whereNotNull('user_id')->orderBy('hits' , 'DESC')->pluck('user_id')->take(10)->toArray();    
        $usershits = Visitor::whereIn('user_id', $usersRange)->orderBy('user_id' , 'ASC')->pluck('hits')->toArray();
        $usernames = User::whereIn('id' , $usersRange)->orderBy('id' , 'ASC')->pluck('name' , 'id')->toArray();
        $usernames = parameterize_array($usernames);
        // dd ($usernames);
        $usersChart = (new LarapexChart)->radarChart()
            ->setTitle('Most Active Users.')
            ->setSubtitle('Total # of Hits.')
            ->addData('Hits', $usershits)
            ->setXAxis($usernames)
            ->setColors(['#FFC107'])
            ->setMarkers(['#ff455f'], 5, 10);

        // APEX CHART MOST VISITED BY DATE 
        $dateRange = Visitor::distinct('date_visited')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->pluck('date_visited')->toArray();
        $nonRegHits = Visitor::distinct('date_visited')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->whereNull('user_id')->pluck('hits')->toArray();
        $RegHits = Visitor::distinct('date_visited')->whereDate('date_visited', '>=' , Carbon::now()->subDays(7))->whereNotNull('user_id')->pluck('hits')->toArray();
        // dd($dateRange);
        // dd($nonRegHits);
        // dd($RegHits);
        $visitChart = (new LarapexChart)->barChart()
            ->setTitle('Most Visited by Date.')
            ->setSubtitle('Hits during 2021.')
            ->addData('Non-registered', $nonRegHits)
            ->addData('Registered', [7, 3, 8, 2, 6, 4])
            ->setXAxis($dateRange);
        
        return view('admin.dashboard', [
            'orders'=>$orders,
            'orderItems' => $orderItems,
            'usersChart' => $usersChart,
            'visitChart' => $visitChart,
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

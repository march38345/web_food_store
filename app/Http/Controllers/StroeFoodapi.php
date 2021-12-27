<?php

namespace App\Http\Controllers;
use App\Models\StroreFood;
use App\Models\Order;
use Illuminate\Http\Request;

class StroeFoodapi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stroe = StroreFood::all();
        return response()->json($stroe);
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
    $arr =  json_decode($request->getContent(),true);
    $name = "";
    $count = "";
    $price = "";
    $allprice = "";
    $count = 0;
    foreach($arr as $item){
        if($count==0){
            $name .= $item['name'];
    $count .=  $item['count'];
    $price .=  $item['price'];
    $allprice .=  $item['allprice'];
        }else{
               $name .= ",";
    $count .= ",";
    $price .= ",";
    $allprice .= ",";
    $name .= $item['name'];
    $count .=  $item['count'];
    $price .=  $item['price'];
    $allprice .=  $item['allprice']; 
        }
    $count++;
        
        
    }
    $order = new Order();
    $order->order = $name;
    $order->count = $count;
    $order->price = $price;
    $order->allprice = $allprice;
    $status =  $order->save();
        return response()->json($status);
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

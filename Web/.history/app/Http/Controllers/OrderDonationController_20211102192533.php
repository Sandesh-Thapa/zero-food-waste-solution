<?php

namespace App\Http\Controllers;

use App\OrderDonation;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;

class OrderDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('donate', compact('orderItems'));
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
        $data = $request->all();
        $store_order_donor['donor_id'] = auth()->user()->id;
        $store_order_donor['total_order'] = $data['total_order'];
        $store_order_donor['order_date'] = $data['order_date'];
        dd($store_order_donor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDonation  $orderDonation
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDonation $orderDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDonation  $orderDonation
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDonation $orderDonation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDonation  $orderDonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDonation $orderDonation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDonation  $orderDonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDonation $orderDonation)
    {
        //
    }
}

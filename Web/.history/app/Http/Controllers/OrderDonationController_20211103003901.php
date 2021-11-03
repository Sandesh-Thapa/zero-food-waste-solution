<?php

namespace App\Http\Controllers;

use App\OrderDonation;
use App\OrderDonationItem;
use App\OrderItem;
use App\User;
use GuzzleHttp\Client;
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
        $total_order = 0;

dd($request->all());
        $client = new Client();
        $latest_donors = OrderDonation::orderBy('order_date','DESC')->take(10)->get();
        $donor_items = [];
        foreach($latest_donors as $key=>$orderData) {
            $donorItems = OrderDonationItem::where('order_id', $orderData->id)->take(10)->get();
            foreach($donorItems as $items) {
                $items = $items->orderItem->name;

                $donor_items[$key][] = $items ;
            }
        }

        $doner_data = [
                "today_data" => json_encode($donor_items[0]),
                "yesterday_data" => json_encode($donor_items[1]),
                "past_2_days_data" => json_encode($donor_items[2]),
                "past_3_days_data" => json_encode($donor_items[3]),
        ];

        $donation_res = $client->request('POST', 'http://192.168.1.3:5000/donations/forecast/',['form_params'=>$doner_data]);

        $next_donation= $donation_res->getBody()->getContents();
        $next_donation = json_decode($next_donation)->data;

        // dd($next_donation);
        $order_donations = OrderDonation::all();
        dd($order_donations[0]);
        // $os = array("Mac", "NT", "Irix", "Linux");
        // if (in_array("Irix", $os)) {
        //     echo "Got Irix";
        // }

        foreach ($data['order_item'] as $order) {
            $total_order += $order['qty'];
        }
        // $order->donor_id = auth()->user()->id;
        // $order->total_order = $total_order;
        // $order->order_date = $data['order_date'];
        // $order->save();

        $orderDonation = OrderDonation::create([
            'donor_id' => auth()->user()->id,
            'total_order' => $total_order,
            'order_date' => $data['order_date']
        ]);
        //dd($orderDonation);
        $itr = 1;

        foreach ($data['order_item'] as $order) {


            $orderDonationItem = OrderDonationItem::create([
                'order_id' => $orderDonation->id,
                'order_item_id' => $itr,
                'item_id' => $order['item_id'],
                'quantity'=> $order['qty']
            ]);
            $itr++;
        }

        return redirect('/')->with('success', 'Items donates successfully.');


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

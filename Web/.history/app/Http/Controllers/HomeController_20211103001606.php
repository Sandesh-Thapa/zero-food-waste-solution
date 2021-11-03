<?php

namespace App\Http\Controllers;
use App\User;
use App\OrderRequest;
use App\OrderRequestItem;
use App\OrderDonation;
use App\OrderDonationItem;
use GuzzleHttp\Client;



class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $total_requests = OrderRequest::count();
        $total_donations = OrderDonation::count();
        $total_donors = User::where('type','donor')->count();
        $latest_requests = OrderRequest::orderBy('order_date','DESC')->take(4)->get();
        $latest_donors = OrderDonation::orderBy('order_date','DESC')->take(10)->get();
//         echo "<pre>";
// print_r($latest_donors);
// die();
        $order_items = [];
        foreach($latest_requests as $key=>$requestData) {
            $orderRequestItems = OrderRequestItem::where('order_id', $requestData->id)->get();
            foreach($orderRequestItems as $items) {
                $items = $items->orderItem->name;
                $order_items[$key][] = $items ;
            }
        }

        $donor_items = [];
        foreach($latest_donors as $key=>$orderData) {
            $donorItems = OrderDonationItem::where('order_id', $orderData->id)->take(10)->get();
            foreach($donorItems as $items) {
                $items = $items->orderItem->name;

                $donor_items[$key][] = $items ;
            }
        }
        // return $order_items;
        $client = new Client();
        $data = [
                "today_data" => json_encode($order_items[0]),
                "yesterday_data" => json_encode($order_items[1]),
                "past_2_days_data" => json_encode($order_items[2]),
                "past_3_days_data" => json_encode($order_items[3]),
        ];

        $res = $client->request('POST', 'http://192.168.1.3:5000/requests/forecast/',['form_params'=>$data]);

        $next_request= $res->getBody()->getContents();
        $next_request = json_decode($next_request)->data;

        $doner_data = [
                "today_data" => json_encode($donor_items[0]),
                "yesterday_data" => json_encode($donor_items[1]),
                "past_2_days_data" => json_encode($donor_items[2]),
                "past_3_days_data" => json_encode($donor_items[3]),
        ];
        $donation_res = $client->request('POST', 'http://192.168.1.3:5000/donations/forecast/',['form_params'=>$data]);

        $next_donation= $donation_res->getBody()->getContents();
        $next_donation = json_decode($next_donation)->data;
        dd($latest_donor_items);
        return view('dashboard', compact(['total_requests', 'total_donations', 'total_donors','next_request', 'next_donation', 'latest_donor_items']));
    }

    // public function getMethodBalance()
    // {
    //     $methods = PaymentMethod::all();
    //     $monthlyBalanceByMethod = [];
    //     $monthlyBalance = 0;

    //     foreach ($methods as $method) {
    //         $balance = Transaction::findByPaymentMethodId($method->id)->thisMonth()->sum('amount');
    //         $monthlyBalance += (float) $balance;
    //         $monthlyBalanceByMethod[$method->name] = $balance;
    //     }
    //     return collect(compact('monthlyBalanceByMethod', 'monthlyBalance'));
    // }

    // public function getAnnualSales()
    // {
    //     $sales = [];
    //     foreach(range(1, 12) as $i) {
    //         $monthlySalesCount = Sale::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();

    //         array_push($sales, $monthlySalesCount);
    //     }
    //     return "[" . implode(',', $sales) . "]";
    // }

    // public function getAnnualClients()
    // {
    //     $clients = [];
    //     foreach(range(1, 12) as $i) {
    //         $monthclients = Sale::selectRaw('count(distinct client_id) as total')
    //             ->whereYear('created_at', Carbon::now()->year)
    //             ->whereMonth('created_at', $i)
    //             ->first();

    //         array_push($clients, $monthclients->total);
    //     }
    //     return "[" . implode(',', $clients) . "]";
    // }

    // public function getAnnualProducts()
    // {
    //     $products = [];
    //     foreach(range(1, 12) as $i) {
    //         $monthproducts = SoldProduct::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->sum('qty');

    //         array_push($products, $monthproducts);
    //     }
    //     return "[" . implode(',', $products) . "]";
    // }

    // public function getMonthlyTransactions()
    // {
    //     $actualmonth = Carbon::now();

    //     $lastmonths = [];
    //     $lastincomes = '';
    //     $lastexpenses = '';
    //     $semesterincomes = 0;
    //     $semesterexpenses = 0;

    //     foreach (range(1, 6) as $i) {
    //         array_push($lastmonths, $actualmonth->shortMonthName);

    //         $incomes = Transaction::where('type', 'income')
    //             ->whereYear('created_at', $actualmonth->year)
    //             ->WhereMonth('created_at', $actualmonth->month)
    //             ->sum('amount');

    //         $semesterincomes += $incomes;
    //         $lastincomes = round($incomes).','.$lastincomes;

    //         $expenses = abs(Transaction::whereIn('type', ['expense', 'payment'])
    //             ->whereYear('created_at', $actualmonth->year)
    //             ->WhereMonth('created_at', $actualmonth->month)
    //             ->sum('amount'));

    //         $semesterexpenses += $expenses;
    //         $lastexpenses = round($expenses).','.$lastexpenses;

    //         $actualmonth->subMonth(1);
    //     }

    //     $lastincomes = '['.$lastincomes.']';
    //     $lastexpenses = '['.$lastexpenses.']';

    //     return collect(compact('lastmonths', 'lastincomes', 'lastexpenses', 'semesterincomes', 'semesterexpenses'));
    // }
}

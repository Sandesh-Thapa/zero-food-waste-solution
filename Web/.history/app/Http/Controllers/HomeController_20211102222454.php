<?php

namespace App\Http\Controllers;
use App\User;
use App\OrderRequest;
use App\OrderRequestItem;
use App\OrderDonation;
use App\OrderDonationItem;

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
        $latest_requests = OrderRequest::orderBy('order_date','DESC')->get();
        foreach($latest_requests as $requestData) {
            $orderRequestItems = OrderRequestItem::where('order_id', $requestData->id)->get();
            dd($orderRequestItems[0]->orderItem->name);
        }
        return view('dashboard', compact(['total_requests', 'total_donations', 'total_donors']));
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

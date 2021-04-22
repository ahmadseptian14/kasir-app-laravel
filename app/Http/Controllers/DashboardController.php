<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $transactions = Transaction::paginate(5);

        $total_transaction = Transaction::count();

        $revenue = Transaction::sum('total_price');
        
        return view('pages.kasir.dashboard-kasir', [
            'total_transaction' => $total_transaction,
            'transactions' =>$transactions,
            'revenue' => $revenue
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Payment;
use App\Models\PaymentInstallment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalPayments = Payment::count();
        $totalInstallments = PaymentInstallment::count();
        $pending = PaymentInstallment::where('status','pendente')->count();
        $paid = PaymentInstallment::where('status','pago')->count();
        $overdue = PaymentInstallment::where('status','vencido')->count();

        return view('dashboard.index', compact(
            'totalClients','totalPayments','totalInstallments','pending','paid','overdue'
        ));
    }
}


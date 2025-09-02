<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\PaymentInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('payments.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_amount' => 'required|numeric|min:0.01',
            'installments' => 'required|integer|min:1',
            'first_due_date' => 'required|date|after_or_equal:today',
        ]);

        $payment = Payment::create([
            'client_id' => $request->client_id,
            'valor_total' => $request->total_amount,
            'parcelas' => $request->installments,
        ]);

        $amountPerInstallment = $request->total_amount / $request->installments;
        $dueDate = Carbon::parse($request->first_due_date);

        for ($i = 1; $i <= $request->installments; $i++) {
            PaymentInstallment::create([
                'payment_id' => $payment->id,
                'numero_parcela' => $i,
                'valor' => $amountPerInstallment,
                'data_vencimento' => $dueDate->copy()->addMonth($i-1),
                'pix_code' => "00020126580014BR.GOV.BCB.PIX0114SEU-PIX-KEY5204000053039865407{$amountPerInstallment}5802BR5911ClienteTest6009SAO PAULO62070503***6304",
                'status' => 'pendente',
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Pagamento parcelado criado com sucesso!');
    }

    public function show(Payment $payment)
    {
        $payment->load('installments','client');
        return view('payments.show', compact('payment'));
    }

    public function history(Client $client)
    {
        $client->load('payments.installments');
        return view('clients.history', compact('client'));
    }

    public function markAsPaid(PaymentInstallment $installment)
    {
        $installment->update(['status' => 'pago']);

        return redirect()->back()->with('success', 'Parcela marcada como paga!');
    }


}


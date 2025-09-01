<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\PaymentInstallment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($clientId = null)
    {
        $clients = Client::all();
        return view('payments.create', [
            'clients' => $clients,
            'selectedClient' => $clientId
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'valor_total' => 'required|numeric|min:1',
            'parcelas' => 'required|integer|min:1|max:12',
            'primeiro_vencimento' => 'required|date'
        ]);

        $payment = Payment::create($request->only(['client_id','valor_total','parcelas']));

        $valorParcela = $payment->valor_total / $payment->parcelas;
        $primeiraData = \Carbon\Carbon::parse($request->primeiro_vencimento);

        for ($i = 1; $i <= $payment->parcelas; $i++) {
            PaymentInstallment::create([
                'payment_id' => $payment->id,
                'numero_parcela' => $i,
                'valor' => $valorParcela,
                'data_vencimento' => $primeiraData->copy()->addMonths($i-1),
                'pix_code' => 'CHAVE PIX - ' . '00020126360014BR.GOV.BCB.PIX0114+5521999999995204000053039865404'
                    . number_format($valorParcela, 2, '.', '') .
                    '5802BR5920ERICH FOURNIER6009SAO PAULO62070503***6304ABCD'
            ]);
        }

        return redirect()->route('payments.show', $payment->id);
    }

    public function show(Payment $payment)
    {
        $payment->load('installments','client');
        return view('payments.show', compact('payment'));
    }

    public function history(Client $client)
    {
        $client->load('payments.installments'); // carrega pagamentos e parcelas
        return view('clients.history', compact('client'));
    }

    public function markAsPaid(PaymentInstallment $installment)
    {
        $installment->update(['status' => 'pago']);

        return redirect()->back()->with('success', 'Parcela marcada como paga!');
    }


}


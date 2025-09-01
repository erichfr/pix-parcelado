<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentInstallment;
use Endroid\QrCode\Builder\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InstallmentController extends Controller
{
    public function indexByStatus($status)
    {
        $validStatus = ['pendente', 'pago', 'vencido'];
        if(!in_array($status, $validStatus)){
            abort(404);
        }

        $installments = PaymentInstallment::where('status', $status)
            ->with('payment.client')
            ->get();

        return view('installments.index', compact('installments','status'));
    }

    public function generateQrCode($id)
    {
        $installment = PaymentInstallment::findOrFail($id);

        $pixPayload = "00020126580014BR.GOV.BCB.PIX0114SEU-PIX-KEY5204000053039865407{$installment->valor}5802BR5911ClienteTest6009SAO PAULO62070503***6304";

        $result = Builder::create()
            ->data($pixPayload)
            ->size(250)
            ->margin(10)
            ->build();

        return response($result->getString(), 200)
            ->header('Content-Type', $result->getMimeType());
    }
}

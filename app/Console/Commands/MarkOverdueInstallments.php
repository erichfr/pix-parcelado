<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PaymentInstallment;
use Carbon\Carbon;

class MarkOverdueInstallments extends Command
{
    protected $signature = 'installments:overdue';
    protected $description = 'Marca parcelas como vencidas se a data de vencimento já passou e ainda estão pendentes';

    public function handle()
    {
        $hoje = Carbon::today();

        $parcelas = PaymentInstallment::where('status', 'pendente')
                        ->where('data_vencimento', '<', $hoje)
                        ->get();

        foreach($parcelas as $p) {
            $p->update(['status' => 'vencido']);
        }

        $this->info(count($parcelas).' parcelas marcadas como vencidas.');
    }
}

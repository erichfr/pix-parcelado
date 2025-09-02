<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $senhaPadrao = '123456';

        $clientes = Client::whereNull('password')->get();

        foreach ($clientes as $cliente) {
            $cliente->update([
                'password' => Hash::make($senhaPadrao),
            ]);
        }

        $this->command->info("Senhas padrão atribuídas a {$clientes->count()} clientes.");
    }
}



<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'João Silva', 'email' => 'joao@example.com','telefone' => '999999999'],
            ['nome' => 'Maria Oliveira', 'email' => 'maria@example.com','telefone' => '999999999'],
            ['nome' => 'Carlos Souza', 'email' => 'carlos@example.com','telefone' => '999999999'],
            ['nome' => 'Ana Paula', 'email' => 'ana@example.com','telefone' => '999999999'],
        ];

        foreach ($clientes as $c) {
            Client::create($c);
        }
    }
}


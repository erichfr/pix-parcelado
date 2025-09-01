<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'João Silva', 'email' => 'joao@example.com'],
            ['nome' => 'Maria Oliveira', 'email' => 'maria@example.com'],
            ['nome' => 'Carlos Souza', 'email' => 'carlos@example.com'],
            ['nome' => 'Ana Paula', 'email' => 'ana@example.com'],
        ];

        foreach ($clientes as $c) {
            Client::create($c);
        }
    }
}


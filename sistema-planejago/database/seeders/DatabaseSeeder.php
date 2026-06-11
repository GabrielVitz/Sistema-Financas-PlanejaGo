<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $agora = now();

        DB::table('tipo_lancamentos')->insert([
            ['id' => 1, 'titulo' => 'Despesa', 'descricao' => 'Saídas de dinheiro', 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 2, 'titulo' => 'Receita', 'descricao' => 'Entradas de dinheiro', 'created_at' => $agora, 'updated_at' => $agora],
        ]);

        DB::table('frequencias')->insert([
            ['id' => 1, 'titulo' => 'Não se repete', 'descricao' => 'Lançamento único', 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 2, 'titulo' => 'Diariamente', 'descricao' => 'Ocorre todos os dias', 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 3, 'titulo' => 'Semanalmente', 'descricao' => 'Ocorre toda semana', 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 4, 'titulo' => 'Mensalmente', 'descricao' => 'Ocorre todo mês', 'created_at' => $agora, 'updated_at' => $agora],
        ]);

        DB::table('categorias')->insert([
            // Categorias de Despesa
            ['id' => 1, 'titulo' => 'Casa', 'descricao' => 'Gastos residenciais', 'tipo_lancamento_id' => 1, 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 2, 'titulo' => 'Educação', 'descricao' => 'Escola e faculdade', 'tipo_lancamento_id' => 1, 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 3, 'titulo' => 'Saúde', 'descricao' => 'Plano de saúde e remédios', 'tipo_lancamento_id' => 1, 'created_at' => $agora, 'updated_at' => $agora],
            
            // Categorias de Receita
            ['id' => 4, 'titulo' => 'Salário', 'descricao' => 'Renda principal', 'tipo_lancamento_id' => 2, 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 5, 'titulo' => 'Investimentos', 'descricao' => 'Rendimentos', 'tipo_lancamento_id' => 2, 'created_at' => $agora, 'updated_at' => $agora],
            ['id' => 6, 'titulo' => 'Empréstimos', 'descricao' => 'Valores tomados', 'tipo_lancamento_id' => 2, 'created_at' => $agora, 'updated_at' => $agora],
        ]);
        
        $this->call([
            UserSeeder::class,
        ]);

        DB::table('lancamentos')->insert([
            [
                'descricao' => 'Plano de Saúde',
                'valor' => 350.00,
                'status_pago' => 1, 
                'data_criacao' => '2026-06-01',
                'data_vencimento' => '2026-06-05',
                'log_data_inclusao' => '2026-06-01 10:00:00',
                'log_data_alteracao' => '2026-06-01 10:00:00',
                'log_versao_registro' => 1,
                'categoria_id' => 3,
                'frequencia_id' => 4,
                'tipo_lancamento_id' => 1,
                'user_id' => 1,
            ],
            [
                'descricao' => 'Mensalidade Escolar',
                'valor' => 600.00,
                'status_pago' => 1,
                'data_criacao' => '2026-06-03',
                'data_vencimento' => '2026-06-06',
                'log_data_inclusao' => '2026-06-03 14:30:00',
                'log_data_alteracao' => '2026-06-03 14:30:00',
                'log_versao_registro' => 1,
                'categoria_id' => 2,
                'frequencia_id' => 4,
                'tipo_lancamento_id' => 1,
                'user_id' => 1,
            ],
            [
                'descricao' => 'Conta de Água',
                'valor' => 95.90,
                'status_pago' => 0,
                'data_criacao' => '2026-06-05',
                'data_vencimento' => '2026-06-15',
                'log_data_inclusao' => '2026-06-05 09:15:00',
                'log_data_alteracao' => '2026-06-05 09:15:00',
                'log_versao_registro' => 1,
                'categoria_id' => 1,
                'frequencia_id' => 4,
                'tipo_lancamento_id' => 1,
                'user_id' => 1,
            ],
            [
                'descricao' => 'Farmácia - Remédios',
                'valor' => 85.00,
                'status_pago' => 1,
                'data_criacao' => '2026-06-06',
                'data_vencimento' => '2026-06-06',
                'log_data_inclusao' => '2026-06-06 20:00:00',
                'log_data_alteracao' => '2026-06-06 20:00:00',
                'log_versao_registro' => 1,
                'categoria_id' => 3,
                'frequencia_id' => 1,
                'tipo_lancamento_id' => 1,
                'user_id' => 1,
            ],
            [
                'descricao' => 'Internet Fibra',
                'valor' => 150.00,
                'status_pago' => 0,
                'data_criacao' => '2026-06-07',
                'data_vencimento' => '2026-06-10',
                'log_data_inclusao' => '2026-06-07 08:00:00',
                'log_data_alteracao' => '2026-06-07 08:00:00',
                'log_versao_registro' => 1,
                'categoria_id' => 1,
                'frequencia_id' => 4,
                'tipo_lancamento_id' => 1,
                'user_id' => 1,
            ]
        ]);
        
    }
}

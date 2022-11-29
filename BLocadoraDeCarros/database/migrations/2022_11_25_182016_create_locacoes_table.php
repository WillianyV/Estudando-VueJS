<?php

use App\Models\Carro;
use App\Models\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inicio_periodo');
            $table->dateTime('data_final_periodo');
            $table->dateTime('data_final_previsto_periodo');
            $table->dateTime('data_final_realizado_periodo');
            $table->float('valor_diaria',8,2);
            $table->integer('km_inicial');
            $table->integer('km_final');
            $table->foreignIdFor(Cliente::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Carro::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locacoes');
    }
};

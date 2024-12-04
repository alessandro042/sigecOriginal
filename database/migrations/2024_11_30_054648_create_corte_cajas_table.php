<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorteCajasTable extends Migration
{
    public function up()
    {
        Schema::create('corte_cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->decimal('total_ingresos', 15, 2)->default(0);
            $table->decimal('total_egresos', 15, 2)->default(0);
            $table->date('fecha_corte');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('corte_cajas');
    }
}

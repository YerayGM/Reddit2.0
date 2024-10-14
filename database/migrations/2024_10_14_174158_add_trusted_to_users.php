<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Agregar columna 'trusted' al modelo User, por defecto en false (0)
        $table->boolean('trusted')->default(0);
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Eliminar la columna 'trusted' en caso de rollback
        $table->dropColumn('trusted');
    });
}

};

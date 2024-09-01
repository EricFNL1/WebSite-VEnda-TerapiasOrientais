<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Verifique e adicione o campo 'appointment_time' se ele não existir
            if (!Schema::hasColumn('appointments', 'appointment_time')) {
                $table->string('appointment_time')->after('appointment_date');
            }

            // Ajuste o campo 'appointment_date' para ser do tipo 'date'
            $table->date('appointment_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Reverta a mudança removendo o campo 'appointment_time' se necessário
            $table->dropColumn('appointment_time');

            // Reverter o tipo do campo 'appointment_date' se necessário
            $table->dateTime('appointment_date')->change();
        });
    }
}

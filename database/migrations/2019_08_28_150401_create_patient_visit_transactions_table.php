<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientVisitTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visit_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_visit_id');
            $table->integer('patient_id');
            $table->string('department');
            $table->string('notes');
            $table->string('practitioner');
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
        Schema::dropIfExists('patient_visit_transactions');
    }
}

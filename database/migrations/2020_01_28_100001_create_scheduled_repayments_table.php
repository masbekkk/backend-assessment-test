<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_repayments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->unsigned();
            $table->unsignedInteger('amount');
            $table->unsignedInteger('outstanding_amount');
            $table->string('currency_code');
            $table->date('due_date');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('loan_id')
                ->references('id')
                ->on('loans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('scheduled_repayments');
        Schema::enableForeignKeyConstraints();
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('fee')->nullable();
            $table->string('status');
            $table->string('bank_code');
            $table->string('account_number');
            $table->string('beneficiary_name');
            $table->string('remark')->nullable();
            $table->string('receipt')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->timestamp('time_served')->nullable();
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
        Schema::dropIfExists('users');
    }
}

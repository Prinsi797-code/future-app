<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurs_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrepreneurs_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->decimal('more_market_capital', 15, 2)->nullable();
            $table->decimal('more_your_stake', 5, 2)->nullable(); // percentage
            $table->decimal('more_stake_funding', 15, 2)->nullable();
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
        Schema::dropIfExists('entrepreneurs_companies');
    }
};
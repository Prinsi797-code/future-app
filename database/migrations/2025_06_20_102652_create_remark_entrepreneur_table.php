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
        Schema::create('remark_entrepreneur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrepreneur_id')->constrained()->onDelete('cascade');
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->decimal('remark_market_capital', 15, 2)->nullable();
            $table->decimal('remark_your_stake', 5, 2)->nullable();
            $table->decimal('remark_company_value', 15, 2)->nullable();
            $table->text('remark_reason')->nullable();
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
        Schema::dropIfExists('remark_entrepreneur');
    }
};
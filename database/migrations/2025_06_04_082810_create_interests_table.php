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
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrepreneur_id')->constrained()->onDelete('cascade');
            $table->foreignId('investor_id')->constrained('users')->onDelete('cascade');


            $table->decimal('market_capital', 15, 2)->nullable();
            $table->decimal('your_stake', 5, 2)->nullable();
            $table->decimal('company_value', 15, 2)->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger('is_counter_offer')->default(0);
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
        Schema::dropIfExists('interests');
    }
};
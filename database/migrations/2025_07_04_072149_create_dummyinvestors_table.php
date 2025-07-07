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
        Schema::create('dummyinvestors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country')->nullable();
            $table->string('linkedin_profile')->nullable(); // Optional
            $table->string('investor_type')->nullable(); // Angel, VC, etc.
            $table->string('investment_range')->nullable(); // Dropdown
            $table->json('preferred_industries')->nullable(); // Multi-select
            $table->json('preferred_geographies')->nullable(); // Multi-select
            $table->string('preferred_startup_stage')->nullable(); // Dropdown
            $table->boolean('actively_investing')->default(false);
            $table->string('investor_profile')->nullable(); // Optional PDF
            $table->string('otp')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('country_code')->nullable();
            $table->string('professional_phone')->nullable();
            $table->string('investment_experince')->nullable();
            $table->string('professional_email')->nullable();
            $table->string('website')->nullable();
            $table->string('designation')->nullable();
            $table->string('organization_name')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->string('serial_number')->nullable()->unique();
            $table->string('company_address', 191)->nullable();
            $table->string('company_country', 191)->nullable();
            $table->string('company_state', 191)->nullable();
            $table->string('company_city', 191)->nullable();
            $table->string('company_zipcode', 10)->nullable();
            $table->string('tax_registration_number', 191)->nullable();
            $table->string('business_logo')->nullable();
            $table->string('company_country_code', 10)->nullable();
            $table->string('current_address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('dob', 191)->nullable();
            $table->string('age', 191)->nullable();
            $table->string('qualification')->nullable();
            $table->string('photo')->nullable();
            $table->text('company_name')->nullable();
            $table->decimal('market_capital', 15, 2)->nullable();
            $table->decimal('your_stake', 5, 2)->nullable();
            $table->decimal('stake_funding', 15, 2)->nullable();

            $table->longText('completed_steps')->nullable();
            $table->json('existing_company')->nullable();
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
        Schema::dropIfExists('dummyinvestors');
    }
};
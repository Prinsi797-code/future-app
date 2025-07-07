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
        Schema::create('dummyentrepreneurs', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('email', 191)->unique();
            $table->string('phone_number')->nullable();
            $table->string('country')->nullable();
            $table->string('business_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('business_stage')->nullable();
            $table->text('website_links')->nullable(); // Optional
            $table->string('pitch_video')->nullable(); // URL or file path
            $table->text('idea_summary')->nullable();
            $table->string('funding_requirement', 191)->nullable(); // in $
            $table->string('pitch_deck')->nullable(); // File path
            $table->boolean('agreed_to_terms')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('otp')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('approved')->default(false);
            $table->string('qualification', 191)->nullable();
            $table->string('age', 3)->nullable();
            $table->string('current_address')->nullable();
            $table->string('city', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->string('pin_code')->nullable();
            $table->boolean('register_business')->default(false);
            $table->string('founder_number', 3)->nullable();
            $table->string('dob', 191)->nullable();
            $table->string('business_state', 191)->nullable();
            $table->string('business_city', 191)->nullable();
            $table->year('business_year')->nullable();
            $table->string('business_year_count', 191)->nullable();
            $table->string('business_describe', 191)->nullable();
            $table->string('business_revenue1', 191)->nullable();
            $table->string('business_revenue2', 191)->nullable();
            $table->string('business_revenue3', 191)->nullable();
            $table->string('invested_amount', 191)->nullable();
            $table->string('business_address', 191)->nullable();
            $table->boolean('interested')->default(false);
            $table->string('serial_number')->nullable()->unique();
            $table->decimal('market_capital', 15, 2)->nullable();
            $table->decimal('your_stake', 5, 2)->nullable();
            $table->decimal('stake_funding', 15, 2)->nullable();
            $table->string('business_logo')->nullable();
            $table->json('product_photos')->nullable();
            $table->string('business_mobile')->nullable();
            $table->string('business_email')->nullable();
            $table->string('registration_type_of_entity')->nullable();
            $table->string('tax_registration_number')->nullable();
            $table->string('own_fund')->nullable();
            $table->string('loan')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('y_business_name', 191)->nullable();
            $table->string('y_brand_name', 191)->nullable();
            $table->string('y_describe_business', 191)->nullable();
            $table->string('y_business_address', 191)->nullable();
            $table->string('y_business_country', 191)->nullable();
            $table->string('y_business_state', 191)->nullable();
            $table->string('y_business_city', 191)->nullable();
            $table->string('y_zipcode', 191)->nullable();
            $table->string('y_type_industries', 191)->nullable();
            $table->string('y_own_fund', 191)->nullable();
            $table->string('y_loan', 191)->nullable();
            $table->string('y_invested_amount', 191)->nullable();
            $table->longText('y_product_photos')->nullable();
            $table->string('y_business_logo')->nullable();
            $table->string('business_country')->nullable();
            $table->string('proposed_business_address')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('y_pitch_deck')->nullable();
            $table->boolean('reject')->default(false);
            $table->boolean('remark')->default(false);
            $table->string('remark_market_capital')->nullable();
            $table->string('remark_your_stake')->nullable();
            $table->string('remark_company_value')->nullable();
            $table->string('remark_reason')->nullable();
            $table->string('reason')->nullable();

            $table->decimal('y_market_capital', 15, 2)->nullable();
            $table->decimal('y_your_stake', 5, 2)->nullable();
            $table->decimal('y_stake_funding', 15, 2)->nullable();
            $table->json('completed_steps')->nullable();

            $table->string('video_upload')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('dummyentrepreneurs');
    }
};
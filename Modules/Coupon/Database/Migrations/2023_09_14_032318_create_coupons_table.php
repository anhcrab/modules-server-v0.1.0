<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->integer('max_uses')->nullable();
            $table->integer('max_uses_user')->nullable();
            $table->enum('type', ['percent', 'fixed'])->default('fixed');
            $table->double('discount_amount', 10, 2)->nullable();
            $table->double('min_amount', 10, 2)->nullable();
            $table->integer('status')->default(1);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};

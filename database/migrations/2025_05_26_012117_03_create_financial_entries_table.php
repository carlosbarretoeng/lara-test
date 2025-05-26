<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description');
            $table->bigInteger('amount');
            $table->string('type');
            $table->date('date');
            $table->uuid('financial_category_id');
            $table->uuid('financial_account_id');
            $table->timestamps();

            $table->foreign('financial_category_id')->references('id')->on('financial_categories')->onDelete('set null');
            $table->foreign('financial_account_id')->references('id')->on('financial_accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_entries');
    }
};

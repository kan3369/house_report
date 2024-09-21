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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('category_id')
                ->constrained();
            $table->string('image');
            $table->text('property');
            $table->string('address');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('property_number');
            $table->date('work_date');
            $table->text('detail')->nullable();;
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fee_percentages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_preset_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('threshold_id')->constrained()->onDelete('cascade');
            $table->decimal('percentage', 5, 2);
            $table->timestamps();

            $table->unique(['fee_preset_id', 'service_id', 'threshold_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fee_percentages');
    }
};


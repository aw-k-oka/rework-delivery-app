<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')
                ->unique()
                ->nullable();
            $table->string('client_name');
            $table->string('client_address');
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->string('status');
            $table->foreignId('staff_id')
                ->nullable()
                ->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

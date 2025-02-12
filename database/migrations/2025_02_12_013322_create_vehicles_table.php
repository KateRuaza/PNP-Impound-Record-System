<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['suspended', 'released'])->default('suspended');
            $table->string('type');
            $table->string('color');
            $table->string('plate_number')->unique();
            $table->string('chasis_number')->unique();
            $table->string('impound_reason')->nullable();
            $table->date('impound_date')->nullable();
            $table->string('owner_first_name');
            $table->string('owner_middle_name')->nullable();
            $table->string('owner_last_name');
            $table->string('owner_nick_name')->nullable();
            $table->integer('owner_age');
            $table->string('owner_sex');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
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
        Schema::create('instance_quotas', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('password')->unique();
            $table->string('api_key')->unique();
            $table->string('statut')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instance_quotas');
    }
};

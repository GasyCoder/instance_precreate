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
            $table->string('url')->nullable()->unique();
            $table->string('password')->nullable()->unique();
            $table->string('api_key')->nullable()->unique();
            $table->string('statut');
            $table->string('db_name')->nullable()->unique();
            $table->string('db_user')->nullable()->unique();
            $table->string('db_pass')->nullable()->unique();
            $table->string('prefix')->nullable()->unique();
            $table->string('instanceId')->nullable()->unique();
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

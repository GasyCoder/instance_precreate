<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('instance_limit')->nullable();
            $table->integer('duration_days')->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('is_default')->default(false);
            $table->boolean('has_sub_plans')->default(false);
            $table->json('features');
            $table->timestamps();
        });

        Schema::create('sub_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price_monthly', 12, 2);
            $table->decimal('price_yearly', 12, 2);
            $table->decimal('price_local', 12, 2); // Ajouté ici car plus pertinent
            $table->json('features');
            $table->boolean('is_default')->default(false); // Pour définir le plan par défaut
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_plans');
        Schema::dropIfExists('plans');
    }
};

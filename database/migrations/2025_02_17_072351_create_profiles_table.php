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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fname', 50)->nullable();
            $table->string('lname', 50)->nullable();
            $table->string('civilite')->nullable();
            $table->string('telephone', 20)->nullable()->unique();
            $table->string('adresse', 255)->nullable();
            $table->string('ville', 100)->nullable();
            $table->string('pays', 100)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->text('bio')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthlocation')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Index pour améliorer les performances des recherches
            $table->index(['fname', 'lname']);
            $table->index('ville');
            $table->index('pays');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

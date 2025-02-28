<?php

use App\Models\Subscription;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_plan_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', [
                Subscription::STATUS_ACTIVE,
                Subscription::STATUS_EXPIRED,
                Subscription::STATUS_CANCELLED,
                Subscription::STATUS_TRIAL
            ])->default(Subscription::STATUS_TRIAL); // Changé en TRIAL par défaut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

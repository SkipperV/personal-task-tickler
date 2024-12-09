<?php

use App\Models\Space;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_status_transitions', function (Blueprint $table) {
            $table->foreignIdFor(Space::class)->constrained()->cascadeOnDelete();
            $table->foreignId('from_status_id')->constrained('task_statuses')->cascadeOnDelete();
            $table->foreignId('to_status_id')->constrained('task_statuses')->cascadeOnDelete();
            $table->primary(['from_status_id', 'to_status_id']);

            $table->index('from_status_id');
            $table->index('to_status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_status_transitions');
    }
};

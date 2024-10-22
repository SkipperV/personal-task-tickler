<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_relations', function (Blueprint $table) {
            $table->foreignId('inward_task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('outward_task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('task_relation_types')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['inward_task_id', 'outward_task_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_relations');
    }
};

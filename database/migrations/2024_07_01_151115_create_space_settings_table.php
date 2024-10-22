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
        Schema::create('space_settings', function (Blueprint $table) {
            $table->foreignId('id')->primary()->constrained('spaces')->cascadeOnDelete();
            $table->integer('archive_delay')->default(-1);
            $table->boolean('show_open_tasks_on_top')->default(false);
            $table->boolean('show_closed_tasks_on_bottom')->default(false);
            $table->boolean('collapse_subtasks')->default(true);
            $table->tinyInteger('hide_from_global_search')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_settings');
    }
};

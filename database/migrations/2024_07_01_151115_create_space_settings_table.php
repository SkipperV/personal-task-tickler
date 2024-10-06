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
            $table->id();
            $table->foreignIdFor(Space::class)->constrained()->cascadeOnDelete();
            $table->integer('archive_delay')->default(-1);
            $table->boolean('put_in_progress_to_the_beginning')->default(false);
            $table->boolean('put_done_to_the_end')->default(false);
            $table->boolean('show_subtasks')->default(true);
            $table->boolean('hide_all_tasks_from_global_search')->default(false);
            $table->boolean('hide_archived_from_global_search')->default(true);
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

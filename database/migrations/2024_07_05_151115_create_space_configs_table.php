<?php

use App\Models\Space;
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
        Schema::create('space_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Space::class)->constrained()->cascadeOnDelete();
            $table->integer('archive_delay');
            $table->boolean('put_in_progress_to_the_beginning');
            $table->boolean('put_done_to_the_end');
            $table->boolean('show_issue_segments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_configs');
    }
};

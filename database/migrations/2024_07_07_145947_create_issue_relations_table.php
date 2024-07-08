<?php

use App\Models\Issue;
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
        Schema::create('issue_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_issue_id');
            $table->unsignedBigInteger('child_issue_id');
            $table->set('type', ['Blocked by', 'Segmented by']);
            $table->timestamps();

            $table->foreign('parent_issue_id')
                ->references('id')
                ->on('issues')
                ->cascadeOnDelete();

            $table->foreign('child_issue_id')
                ->references('id')
                ->on('issues')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_relations');
    }
};

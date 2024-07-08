<?php

use App\Models\IssueStatus;
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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Space::class)->constrained()->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('issue_statuses')->cascadeOnDelete();
            $table->unsignedBigInteger('id_within_space');
            $table->unsignedBigInteger('rank');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->dateTime('deadline_at')->nullable();
            $table->dateTime('done_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};

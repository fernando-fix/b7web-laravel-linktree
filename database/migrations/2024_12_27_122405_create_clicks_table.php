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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->unsignedBigInteger('link_id');
            $table->date('date');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('link_id')->references('id')->on('links');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key
        Schema::table('clicks', function (Blueprint $table) {
            $table->dropForeign(['link_id']);
        });

        Schema::dropIfExists('clicks');
    }
};

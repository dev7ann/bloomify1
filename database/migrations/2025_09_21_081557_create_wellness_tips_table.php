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
        Schema::create('wellness_tips', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('title'); // title of the tip
            $table->text('content'); // content of the tip
            $table->string('category')->nullable(); // category (like stress, sleep, diet, etc.)
            $table->unsignedBigInteger('created_by')->nullable(); // user/admin who created the tip
            $table->timestamps(); // created_at & updated_at

            // optional: link to users table if you want
            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wellness_tips');
    }
};

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->string("slug");
            $table->string("description");
            $table->string("image");
            $table->string("status")->default("draft");
            $table->text("body");

            // Not needed because of the foreignId() method
            // $table->bigInteger('user_id')->unsigned();
            // $table->bigInteger('category_id')->unsigned();

            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('category_id')->constrained()->references('id')->on('categories')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

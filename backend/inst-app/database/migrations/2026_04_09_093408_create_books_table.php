<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('name');
            $table->string('author');
            $table->decimal('price', 8, 2);
            $table->text('detail')->nullable();
            $table->string('language')->nullable();
            $table->integer('rating')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->integer('amount')->default(0);
            $table->date('release_date')->nullable();
            $table->boolean('is_on_sale')->default(false);
            $table->timestamps();
            $table->boolean('is_booktok')->default(false);
            $table->boolean('is_recommended')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

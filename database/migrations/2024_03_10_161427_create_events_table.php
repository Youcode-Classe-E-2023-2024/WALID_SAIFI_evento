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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('date');
            $table->string('location');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('available_seats');
            $table->decimal('price', 8, 2); // Utilisez la colonne DECIMAL pour stocker les prix
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id'); // Ajout de la colonne pour l'ID du créateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');// Assurez-vous d'avoir une table "users" avec une colonne "id"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

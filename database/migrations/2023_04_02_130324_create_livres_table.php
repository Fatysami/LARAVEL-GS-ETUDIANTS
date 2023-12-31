<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('titre');
            $table->unsignedBigInteger('auteur_id');
            $table->foreign('auteur_id')->references('id')->on('auteurs')->onDelete('cascade');
            $table->unsignedBigInteger('categ_id');
            $table->foreign('categ_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('emplacement_id');
            $table->foreign('emplacement_id')->references('id')->on('emplacements')->onDelete('cascade');
            $table->integer('annee_publication');
            $table->string('image_couverture')->nullable();
            $table->text('description')->nullable();
            $table->integer('disponibilite')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livres');
    }
};

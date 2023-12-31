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
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('livre_id');
            $table->unsignedBigInteger('emprunteur_id');
            $table->dateTime('date_emprunt');
            $table->dateTime('date_retour_prevue');
            $table->dateTime('date_retour_reelle')->nullable();
            $table->enum('statut_emprunt', ['en_cours', 'en_retard', 'termine'])->default('en_cours');
            $table->text('notes')->nullable();
            $table->timestamps();
    
            $table->foreign('livre_id')->references('id')->on('livres');
            $table->foreign('emprunteur_id')->references('id')->on('utilisateurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprunts');
    }
};

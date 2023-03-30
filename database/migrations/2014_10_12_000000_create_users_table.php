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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom'); 
            $table->date("dateNs")->nullable();
            $table->string('lieuNs')->nullable();
            $table->string('lycee')->nullable();
            $table->string('cin')->nullable();
            $table->string('cne')->nullable()->unique();          
            $table->string('niveauBac')->nullable();
            $table->float('bacMoyen')->nullable();
            $table->string('tel')->nullable();
            $table->boolean("isProf")->default(false);
            $table->boolean("isAdmin")->default(false);
            $table->string('filiere')->nullable();
            $table->integer('annee')->nullable();
            $table->integer('anneeScolaire')->nullable();
            $table->string('mat1')->nullable();
            $table->string('mat2')->nullable();
            $table->string('mat3')->nullable();
            $table->string('mat4')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $abreviations = config('variables.abreviations');
            $table->string('etudiant_id')->unique();
            $table->foreign('etudiant_id')->references('cne')->on('users')->onDelete('cascade');
            foreach($abreviations as $mat => $val ) {
                for($semestre=1;$semestre<5;$semestre++){
                    for($exam=1;$exam<3;$exam++){
                        $table->float($mat.$exam.$semestre ,8 ,2)->nullable();
                    }
                }
            }
            foreach($abreviations as $mat => $val ) {
                $table->float($mat.'N', 8, 2)->nullable();
                $table->float($mat.'P', 8, 2)->nullable();
            }
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

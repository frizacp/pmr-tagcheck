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
        Schema::create('tagcheck', function (Blueprint $table) {
            $table->id();
            $table->integer('bib')->nullable();
            $table->string('name', 30)->nullable();
            $table->string('gender', 7)->nullable();
            $table->string('contest', 20)->nullable();
            $table->string('chipcode', 50)->nullable();
            $table->time('finishtime')->nullable();
            $table->time('chiptime')->nullable();
            $table->integer('overallplace')->nullable();
            $table->integer('divisionplace')->nullable();
            $table->string('pace', 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagcheck');
    }
};

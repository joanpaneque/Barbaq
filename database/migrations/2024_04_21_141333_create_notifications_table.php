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
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->timestamps();

        $table->foreignId('user_id')->constrained();
        $table->text('message');
        $table->boolean('seen')->default(false);
        $table->string('primary_link_text')->default('Aceptar'); 
        $table->string('primary_link')->nullable();
        $table->string('primary_link_method')->default('post');
        $table->string('secondary_link_text')->default('Denegar'); 
        $table->string('secondary_link')->nullable();
        $table->string('secondary_link_method')->default('post');
        
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

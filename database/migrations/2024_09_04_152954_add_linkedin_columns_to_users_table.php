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
        Schema::table('users', function (Blueprint $table) {
            $table->string('linkedin_id')->nullable();
            $table->string('linkedin_token')->nullable();
            $table->string('avatar')->nullable(); // For LinkedIn profile picture
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['linkedin_id', 'linkedin_token', 'avatar']);
        });
    }
    
};

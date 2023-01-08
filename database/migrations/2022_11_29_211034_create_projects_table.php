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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('project_id')->index()->constrained('projects', 'id')->cascadeOnDelete();
            $table->foreignId('author_id')->index()->constrained('users', 'id')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('projects');
    }
};

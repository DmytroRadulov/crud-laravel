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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('label_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index()->constrained('projects', 'id')->cascadeOnDelete();
            $table->foreignId('label_id')->index()->constrained('labels', 'id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_project');
        Schema::dropIfExists('labels');
    }
};

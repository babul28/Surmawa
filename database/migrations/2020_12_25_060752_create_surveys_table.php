<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->nullable()->constrained()->onUpdate('cascade');
            $table->string('name');
            $table->string('department_name');
            $table->string('faculty_name');
            $table->string('university_name');
            $table->string('survey_code');
            $table->unsignedTinyInteger('status');
            $table->timestamp('expired_at');
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
        Schema::dropIfExists('surveys');
    }
}

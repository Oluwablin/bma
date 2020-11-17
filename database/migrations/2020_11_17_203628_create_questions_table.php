<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('QuestionRef');
            $table->string('question');
            $table->boolean('is_general');
            $table->string('categories')->nullable();
            $table->integer('point')->nullable();
            $table->string('icon_url')->nullable();
            $table->inteer('duration')->nullable();
            $table->string('choice_1')->nullable();
            $table->boolean('is_correct_choice_1');
            $table->string('icon_url_1')->nullable();
            $table->string('Choice_2')->nullable();
            $table->boolean('is_correct_choice_2');
            $table->string('icon_url_2')->nullable();
            $table->string('Choice_3')->nullable();
            $table->boolean('is_correct_choice_3');
            $table->string('icon_url_3')->nullable();
            $table->string('Choice_4')->nullable();
            $table->boolean('is_correct_choice_4');
            $table->string('icon_url_4')->nullable();
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
        Schema::dropIfExists('questions');
    }
}

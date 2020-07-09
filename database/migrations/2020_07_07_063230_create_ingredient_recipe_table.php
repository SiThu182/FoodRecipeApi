<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->unsignedBigInteger('measurement_unit_id');
            $table->unsignedBigInteger('measurement_quantity_id');
            $table->timestamps();

            $table->foreign('recipe_id')
                  ->references('id')->on('recipes')
                  ->onDelete('cascade');

            $table->foreign('ingredient_id')
                  ->references('id')->on('ingredients')
                  ->onDelete('cascade');

            $table->foreign('measurement_unit_id')
                  ->references('id')->on('measurement_units')
                  ->onDelete('cascade');


            $table->foreign('measurement_quantity_id')
                  ->references('id')->on('measurement_quantities')
                  ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
    }
}

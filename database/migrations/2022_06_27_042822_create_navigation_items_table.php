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
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navigation_group_id');
            $table->string('name');
            $table->string('sequence')->unique();
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('navigation_group_id')
            ->references('id')->on('navigation_groups')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation_items');
    }
};

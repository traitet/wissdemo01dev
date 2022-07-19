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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('permission_id');
            $table->string('message');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('emp_id')
            ->references('id')->on('users')->onDelete('restrict');
            $table->foreign('permission_id')
            ->references('id')->on('permissions')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};

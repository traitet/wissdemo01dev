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
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('permission_id');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('email')
            ->references('email')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('user_permissions');
    }
};

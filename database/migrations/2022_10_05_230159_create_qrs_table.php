<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('qrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('content');
            $table->string('size');
            $table->text('qr');
            $table->timestamps();

            $table->index('user_id', 'qrs_to_users_idx');
            $table->foreign('user_id', 'qrs_to_users_fk')
                ->on('users')->references('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('qrs');
    }
};

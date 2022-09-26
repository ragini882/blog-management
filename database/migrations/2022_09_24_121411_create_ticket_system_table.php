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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('issue_type');
            $table->string('email');
            $table->text('description');
            $table->timestamps();
        });

        // Schema::create('issues', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('issue_type');
        //     $table->timestamps();
        // });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id');
            $table->integer('user_id');
            $table->text('message');
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
        Schema::dropIfExists('tickets');
        //  Schema::dropIfExists('issues');
        Schema::dropIfExists('messages');
    }
};

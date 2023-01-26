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
        Schema::create('tenant_db_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('db_name');
            $table->string('db_host');
            $table->string('db_port');
            $table->string('db_username');
            $table->string('db_password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_db_details');
    }
};

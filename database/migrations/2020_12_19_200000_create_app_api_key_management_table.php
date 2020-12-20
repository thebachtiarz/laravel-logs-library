<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppApiKeyManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_api_key_management', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('app_key')->unique();
            $table->boolean('is_active')->default(false);
            $table->dateTime('active_until');
            $table->timestamp('last_used')->nullable();
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
        Schema::dropIfExists('app_api_key_management');
    }
}

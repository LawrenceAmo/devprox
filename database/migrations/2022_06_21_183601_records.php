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
         Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements("id")->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('initials');
            $table->integer('age')->default(0);
            $table->date('date_of_birth');
             $table->timestamp('created_at')->useCurrent();
             $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};

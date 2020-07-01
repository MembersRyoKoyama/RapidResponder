<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('mail');
            $table->string('tel');
            $table->increments('products_id');
            $table->text('content');
            $table->string('date');
            $table->increments('end');
            $table->increments('staff_id');

            /*$table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cate_id');
            $table->string('title');
            $table->text('content');
            $table->string('label_id');
            $table->string('desc');
            $table->unsignedInteger('user_id');
            $table->timestamp('public_at');
            $table->unsignedTinyInteger('status')->default('1')->comment('0->delete,1->normal');
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
        Schema::dropIfExists('articles');
    }
}

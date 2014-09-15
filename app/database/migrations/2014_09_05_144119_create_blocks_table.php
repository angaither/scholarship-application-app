<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blocks', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('page_id')->index();
      $table->string('block_title')->index();
      $table->longtext('block_description');
      $table->longtext('block_body');
      // @TODO: add a class
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
    Schema::drop('blocks');
  }

}

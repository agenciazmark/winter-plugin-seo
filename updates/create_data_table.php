<?php namespace Zmark\Seo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateDataTable extends Migration
{

    public function up()
    {
        Schema::create('zmark_seo_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type');
            $table->string('reference');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zmark_seo_data');
    }

}

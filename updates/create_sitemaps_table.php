<?php namespace Zmark\Seo\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateSitemapsTable extends Migration
{
    public function up()
    {
        Schema::create('zmark_seo_sitemaps', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('theme')->nullable()->index();
            $table->mediumtext('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zmark_seo_sitemaps');
    }
}

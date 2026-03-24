<?php

namespace Xitara\Unimatrix\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('xitara_unimatrix_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('icon', 255)->nullable();
            $table->string('url', 2048);
            $table->string('link_type', 32);
            $table->string('host', 255)->nullable();
            $table->integer('port')->nullable();
            $table->text('proxy_config')->nullable();
            $table->text('docker_stack')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('link_type');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('xitara_unimatrix_links');
    }
}

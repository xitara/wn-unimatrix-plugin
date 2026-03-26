<?php

namespace Xitara\Unimatrix\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateLinkPagesTable extends Migration
{
    public function up()
    {
        Schema::create('xitara_unimatrix_link_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->mediumText('structure')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('xitara_unimatrix_link_pages');
    }
}

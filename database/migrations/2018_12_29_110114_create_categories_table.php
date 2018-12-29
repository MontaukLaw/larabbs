<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            //自增id
            $table->increments('id');
            //名称string, 应该就是varchar吧,还建了索引, 有索引将来可以搜索用.
            $table->string('name')->index()->comment('名称');
            //text就是text, 可为空
            $table->text('description')->nullable()->comment('描述');
            //integer应该是int, 默认值是0
            $table->integer('post_count')->default(0)->comment('帖子数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

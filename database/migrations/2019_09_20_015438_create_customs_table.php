<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customs_districts', function (Blueprint $table) {
            $table->char('code', 4)->comment('关区代码');
            $table->string('name', 50)->comment('关区名称');
            $table->primary(['code']);
        });

        Schema::create('customs_currencies', function (Blueprint $table) {
            $table->char('code', 3)->comment('币制代码');
            $table->string('code_en', 3)->comment('英文简码');
            $table->string('name', 50)->comment('中文名称');
            $table->primary(['code']);
        });

        Schema::create('customs_units', function (Blueprint $table) {
            $table->char('code', 3)->comment('计量单位代码');
            $table->string('name', 50)->comment('计量单位中文名称');
            $table->primary(['code']);
        });

        Schema::create('customs_hs_codes', function (Blueprint $table){
            $table->char('code', 10)->comment('商品编码');
            $table->string('name', 100)->comment('商品名称');
            $table->string('describe', 255)->comment('商品描述');
            $table->char('unit1', 3)->comment('法一');
            $table->char('unit2', 3)->comment('法二');
            $table->text('elements')->comment('申报要素');
            $table->primary(['code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customs_districts');
        Schema::dropIfExists('customs_currencies');
        Schema::dropIfExists('customs_units');
        Schema::dropIfExists('customs_hs_codes');
    }
}
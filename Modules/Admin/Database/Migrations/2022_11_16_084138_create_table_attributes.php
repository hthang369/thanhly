<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Laka\Core\Plugins\Nestedset\NestedSet;

class CreateTableAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100);
            $table->string('language', 150);
            $table->text('value');
            $table->nestedSet([
                NestedSet::PARENT_ID => NestedSet::PARENT_ID,
                NestedSet::LFT => 'attr_lft',
                NestedSet::RGT => 'attr_rgt'
            ]);
            $table->unsignedTinyInteger('priority');
            $table->unsignedInteger('post_id')->nullable();
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
        Schema::dropIfExists('attributes');
    }
}

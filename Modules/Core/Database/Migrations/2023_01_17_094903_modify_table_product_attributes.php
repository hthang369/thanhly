<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Laka\Core\Plugins\Nestedset\NestedSet;

class ModifyTableProductAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->nestedSet([
                NestedSet::PARENT_ID => NestedSet::PARENT_ID,
                NestedSet::LFT => 'attr_lft',
                NestedSet::RGT => 'attr_rgt',
                'after' => 'attribute_id'
            ]);
            $table->unsignedTinyInteger('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}

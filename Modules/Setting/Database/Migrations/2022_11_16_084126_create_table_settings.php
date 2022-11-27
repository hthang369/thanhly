<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Laka\Core\Plugins\Nestedset\NestedSet;

class CreateTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100);
            $table->string('language', 150);
            $table->text('value');
            $table->nestedSet([
                NestedSet::PARENT_ID => NestedSet::PARENT_ID,
                NestedSet::LFT => 'setting_lft',
                NestedSet::RGT => 'setting_rgt'
            ]);
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
        Schema::dropIfExists('settings');
    }
}

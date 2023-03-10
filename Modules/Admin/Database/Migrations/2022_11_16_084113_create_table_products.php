<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admin\Enums\ActionStatus;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('sku', 100);
            $table->decimal('price', 8, 2, true);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('uom_id')->nullable();
            $table->string('except', 150)->nullable();
            $table->text('content');
            $table->enum('status', ActionStatus::listConstains())->default(ActionStatus::ACTIVE);
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
        Schema::dropIfExists('products');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDomainColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $listTable = [
            'advertises',
            'attributes',
            'brands',
            'categories',
            'menus',
            'posts',
            'products',
            'settings',
            'tags'
        ];
        foreach($listTable as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->unsignedInteger('domain_at')->after('domain');
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}

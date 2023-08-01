<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateActionColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $listColumns = DB::table('information_schema.COLUMNS')->where([
            'TABLE_SCHEMA' => DB::connection()->getDatabaseName(),
            'DATA_TYPE' => 'enum'
        ])->where('COLUMN_NAME', 'LIKE', '%status')->pluck('COLUMN_NAME', 'TABLE_NAME');
        $listColumns->each(function($col, $table) {
            Schema::table($table, function (Blueprint $table) use($col) {
                $table->renameColumn($col, 'is_status');
            });    
        });
        $listColumns = DB::table('information_schema.COLUMNS')->where([
            'TABLE_SCHEMA' => DB::connection()->getDatabaseName(),
            'DATA_TYPE' => 'enum'
        ])->where('COLUMN_NAME', 'LIKE', '%ishot')->pluck('COLUMN_NAME', 'TABLE_NAME');
        $listColumns->each(function($col, $table) {
            Schema::table($table, function (Blueprint $table) use($col) {
                $table->renameColumn($col, 'is_hot');
            });    
        });
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

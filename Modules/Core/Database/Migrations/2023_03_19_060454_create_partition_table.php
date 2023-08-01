<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Laka\Core\Facades\Schema;

class CreatePartitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $listColumns = DB::table('information_schema.COLUMNS')->where([
        //     'TABLE_SCHEMA' => DB::connection()->getDatabaseName(),
        //     'COLUMN_NAME' => 'domain_at'
        // ])->pluck('COLUMN_NAME', 'TABLE_NAME');
        $listColumns = collect(['currencies' => 'domain_at']);
        $listColumns->each(function($col, $tableName) {
            Schema::table($tableName, function (Blueprint $table) use($col) {
                $table->primaryExists(['id', $col]);
                $table->partitionHash($col, 2);
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
        Schema::dropIfExists('partition');
    }
}

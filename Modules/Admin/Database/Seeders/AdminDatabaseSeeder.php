<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Laka\Core\Entities\DomainModel;
use Laka\Core\Enums\ActionStatus;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $listData = [
        //     [
        //         'name' => env('FIRST_DOMAIN'),
        //         'status' => ActionStatus::ACTIVE
        //     ],
        //     [
        //         'name' => env('SECOND_DOMAIN'),
        //         'status' => ActionStatus::ACTIVE
        //     ]
        // ];
        // foreach($listData as $item) {
        //     DomainModel::create($item);
        // }

        // $this->call("OthersTableSeeder");
    }
}

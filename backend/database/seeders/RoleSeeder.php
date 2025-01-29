<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enum\Roles;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{

    public const TABLE_NAME = 'roles';
    public const TABLE_PREFIX = 'croc_';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Roles::cases() as $role){
            DB::table(self::TABLE_PREFIX . self::TABLE_NAME)->insert([
                "role_id" => $role->value,
                "created_at" => NOW()
            ]);
        }
    }
}

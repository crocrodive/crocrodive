<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingList = ["non évaluée", "en cours d'acquisition", "acquise", "absent"];

        foreach($ratingList as $rating){
            DB::table('croc_ratings')->insert([
                "rati_label" => $rating
            ]);
        }
    }
}

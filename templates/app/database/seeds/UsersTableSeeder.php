<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        User::create([
            "name" => "__APP__DATABASE__SEEDS__NAME__",
            "password" => "__APP__DATABASE__SEEDS__PASSWORD__",
            "email" => "__APP__DATABASE__SEEDS__EMAIL__",
            "type" => 1,
            "status" => $faker->numberBetween(0, 1),
        ]);
        
        foreach (range(1, 20) as $index) {
            User::create([
                "name" => $faker->name,
                "password" => "1234",
                "email" => $faker->companyEmail,
                "type" => $faker->numberBetween(-1, 1),
                "status" => $faker->numberBetween(0, 1),
            ]);
        }
    }

}

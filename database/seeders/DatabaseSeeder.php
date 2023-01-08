<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Continent;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $value = file_get_contents('continent.json');


        $continents = json_decode($value, true);

        $item = file_get_contents('country.json');

        $countries = json_decode($item, true);

        foreach ($continents as $code) {
            if (Continent::where('code', $code)->first()) {
                continue;
            }
            $continent = Continent::create(['code' => $code]);
            foreach ($countries as $country) {
                $continent->countries()->create([
                    'code' => $country
                ]);
            }
        }

        $projects = Project::factory(100)->create();

        User::factory(100)->make()->each(function ($user) use ($countries,$projects) {
            $user->country_id = $countries->random()->id;
            $user->save();
            $user->projects()->attach($projects->random(rand(5, 10))->pluck('id'));
        });

          Label::factory(100)->make()->each(function ($label) use ($projects) {
              $label->save();
              $label->projects()->attach($projects->random(rand(5, 10))->pluck('id'));
        });

    }
}

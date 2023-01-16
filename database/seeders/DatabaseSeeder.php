<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]); //create one user with filled fields

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]); //pass in user_id

        /* Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'laravel, javascript',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam'
        ]);

        Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'laravel, backend, api',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'email2@email.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam'
        ]); */

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

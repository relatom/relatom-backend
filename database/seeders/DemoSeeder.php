<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
			5 utilisateur demo :
			- un admin 
			- un organisateur
			- un parent pratiquant + 2 enfants 
			- un parent + 1 enfants 
			- un pratiquant

			10 événement + commentaire 
		*/ 

        // create an admin
        User::factory()->count(1)->create(['email' => 'admin@gmail.com']);

        $parent = User::factory()
            ->hasChildren(3, function (array $attributes, User $parent) {
                return [
                    'lastname' => $parent->lastname,
                    'email' => null,
                    'credential_id' => null];
            })
            ->create(['email' => 'parent@gmail.com']);

        Event::factory()->count(10)->create();

    }
}

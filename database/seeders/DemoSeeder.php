<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Member;
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
        Member::factory()->count(1)->create(['email' => 'admin@gmail.com']);

        $parent = Member::factory()
            ->hasChildren(3, function (array $attributes, Member $parent) {
                return [
                    'lastname' => $parent->lastname,
                    'email' => null,
                    'user_id' => null];
            })
            ->create(['email' => 'parent@gmail.com']);

        Event::factory()->count(10)->create();

    }
}

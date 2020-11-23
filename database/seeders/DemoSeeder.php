<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Member;
use App\Models\Organization;
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
        Organization::factory()
        ->hasMembers(1, function (array $attributes, Organization $organization) {
            return ['email' => 'admin@gmail.com'];
        })
        ->hasEvents(10)
        ->create();



        /* 
			5 utilisateur demo :
			- un admin 
			- un organisateur
			- un parent pratiquant + 2 enfants 
			- un parent + 1 enfants 
			- un pratiquant

			10 événement + commentaire 
		*/ 

            /* 
        Organization::factory()
            ->has(
                Post::factory()
                        ->count(3)
                        ->state(function (array $attributes, User $user) {
                            return ['user_type' => $user->type];
                        })
            )
            ->has(
                Post::factory()
                        ->count(3)
                        ->state(function (array $attributes, User $user) {
                            return ['user_type' => $user->type];
                        })
            )
            ->hasMember(5, function(array $attributes,  ))
            ->hasEvent()
            ->create();

*/ 


        // create an admin
        /* Member::factory()->count(1)->create(['email' => 'admin@gmail.com']);

        

        Event::factory()->count(10)->create(); */ 

    }
}

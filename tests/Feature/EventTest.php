<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }

    public function testStore() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 16:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(201);
    }

    public function testStoreWithoutTitle() {

        $response = $this->post('/events', [
            'title' => null,
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 16:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(201);
    }


    public function testStoreWithoutNotes() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 16:00:00',
            'notes' => null
        ]);

        $response
            ->assertStatus(201);
    }

    public function testStoreWithEndsAtBeforeStartsAt() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 12:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(422);
    }

    public function testStoreWithIsAllDayEndsAtAfterOrEqualsStartsAt() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => true,
            'starts_at' => '2020-10-24 12:00:00',
            'ends_at' => '2020-10-24 12:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(201);
    }

    public function testStoreWithIsNotAllDayEndsAtAfterStartsAt() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 15:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(201);
    }

    public function testStoreWithIsNotAllDayEndsAtEqualsStartsAt() {

        $response = $this->post('/events', [
            'title' => 'Séance de l\'école de pagaie',
            'is_all_day' => false,
            'starts_at' => '2020-10-24 14:00:00',
            'ends_at' => '2020-10-24 14:00:00',
            'notes' => 'Petites notes sur l\'organisation de l\'évènement de samedi'
        ]);

        $response
            ->assertStatus(422);
    }
}

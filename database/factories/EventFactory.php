<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Séance du ',
            'is_all_day' => false,
            'notes' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'starts_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 15 days', $timezone = null),
            'ends_at' => function (array $attributes) {
                return \Carbon\Carbon::instance($attributes['starts_at'])->add('hour', 2);
            }
        ];
    }
}

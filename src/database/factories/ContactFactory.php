<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use Faker\Factory as FakerFactory;

class ContactFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // mb_internal_encoding("UTF-8");
        $faker = \Faker\Factory::create();

        return [
            'category_id' => $faker->numberBetween(1,5),
            'first_name' => '太郎',
            'last_name' => '山田',
            'gender' => $faker->numberBetween(1,3),
            'email' => $faker->unique()->safeEmail(),
            'tel' => $faker->randomElement(['080', '090', '070']) . $faker->numerify('########'),
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101',
            'detail' => $faker->text(100),
        ];
    }
}

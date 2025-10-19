<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
// use Faker\Factory as FakerFactory;

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
        // $this->faker = FakerFactory::create('ja_JP'); //日本語対応

        return [
            //ダミーデータ
            'category_id' => $this->faker->numberBetween(1,5),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'building' => $this->faker->secondaryAddress(), //建物名
            'detail' => $this->faker->realText(100), //お問い合わせ内容
        ];
    }
}

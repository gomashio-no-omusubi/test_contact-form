<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first();
        $detail = match ($category->content) {
            '商品のお届けについて' => '注文した商品がまだ届きません。配送状況の確認をお願いします。',
            '商品の交換について' => '届いた商品の色が違いました。交換の手続きの手配をお願いします。',
            '商品トラブル'       => '商品が破損していました。返金対応は可能でしょうか。その際の商品の返品処理も併せてご指示ください。',
            'ショップへのお問い合わせ' => '営業時間を教えてください。',
            default             => 'その他、サービス全般に関する質問です。',
        };

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'last_name'  => $this->faker->lastName(),
            'first_name'   => $this->faker->firstName(),
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->safeEmail(),
            'tel'          =>  $this->faker->numerify('0##########'),
            'address' => $this->faker->prefecture() . $this->faker->city() . $this->faker->streetAddress(),
            'building'    => $this->faker->secondaryAddress(),
            'detail' => $detail,
        ];
    }
}

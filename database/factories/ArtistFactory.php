<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'YOASOBI',
            'description' => 'YOASOBI is a Japanese pop superduo formed in 2019 by Sony Music Entertainment Japan, composed of Vocaloid producer Ayase and singer-songwriter Ikura. Represented by the slogan "novel into music", the duo originally released songs based on selected short stories posted on Monogatary.com [ja], a social media website for creative writing operated by the label. Stories were later also sourced from various media like stories written by professional authors, books, letters, and plays, etc.',
            'is_verified' => true
        ];
    }
}

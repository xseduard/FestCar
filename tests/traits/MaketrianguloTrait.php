<?php

use Faker\Factory as Faker;
use App\Models\triangulo;
use App\Repositories\trianguloRepository;

trait MaketrianguloTrait
{
    /**
     * Create fake instance of triangulo and save it in database
     *
     * @param array $trianguloFields
     * @return triangulo
     */
    public function maketriangulo($trianguloFields = [])
    {
        /** @var trianguloRepository $trianguloRepo */
        $trianguloRepo = App::make(trianguloRepository::class);
        $theme = $this->faketrianguloData($trianguloFields);
        return $trianguloRepo->create($theme);
    }

    /**
     * Get fake instance of triangulo
     *
     * @param array $trianguloFields
     * @return triangulo
     */
    public function faketriangulo($trianguloFields = [])
    {
        return new triangulo($this->faketrianguloData($trianguloFields));
    }

    /**
     * Get fake data of triangulo
     *
     * @param array $postFields
     * @return array
     */
    public function faketrianguloData($trianguloFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'texto' => $fake->word,
            'numero' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $trianguloFields);
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\Pruebauno;
use App\Repositories\PruebaunoRepository;

trait MakePruebaunoTrait
{
    /**
     * Create fake instance of Pruebauno and save it in database
     *
     * @param array $pruebaunoFields
     * @return Pruebauno
     */
    public function makePruebauno($pruebaunoFields = [])
    {
        /** @var PruebaunoRepository $pruebaunoRepo */
        $pruebaunoRepo = App::make(PruebaunoRepository::class);
        $theme = $this->fakePruebaunoData($pruebaunoFields);
        return $pruebaunoRepo->create($theme);
    }

    /**
     * Get fake instance of Pruebauno
     *
     * @param array $pruebaunoFields
     * @return Pruebauno
     */
    public function fakePruebauno($pruebaunoFields = [])
    {
        return new Pruebauno($this->fakePruebaunoData($pruebaunoFields));
    }

    /**
     * Get fake data of Pruebauno
     *
     * @param array $postFields
     * @return array
     */
    public function fakePruebaunoData($pruebaunoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->word,
            'pru_nombre' => $fake->word,
            'pru_cantidad' => $fake->randomDigitNotNull,
            'pru_categoria' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pruebaunoFields);
    }
}
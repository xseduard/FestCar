<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PruebaunoApiTest extends TestCase
{
    use MakePruebaunoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_pruebaunos()
    {
        $pruebauno = $this->fakePruebaunoData();
        $this->json('POST', "/api/v1/pruebaunos", $pruebauno);

        $this->assertApiResponse($pruebauno);
    }

    /**
     * @test
     */
    function it_can_read_pruebauno()
    {
        $pruebauno = $this->makePruebauno();
        $this->json("GET", "/api/v1/pruebaunos/{$pruebauno->id}");

        $this->assertApiResponse($pruebauno->toArray());
    }

    /**
     * @test
     */
    function it_can_update_pruebauno()
    {
        $pruebauno = $this->makePruebauno();
        $editedPruebauno = $this->fakePruebaunoData();

        $this->json('PUT', "/api/v1/pruebaunos/{$pruebauno->id}", $editedPruebauno);

        $this->assertApiResponse($editedPruebauno);
    }

    /**
     * @test
     */
    function it_can_delete_pruebaunos()
    {
        $pruebauno = $this->makePruebauno();
        $this->json("DELETE", "/api/v1/pruebaunos/{$pruebauno->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/pruebaunos/{$pruebauno->id}");

        $this->assertResponseStatus(404);
    }

}

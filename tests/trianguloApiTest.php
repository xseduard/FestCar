<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class trianguloApiTest extends TestCase
{
    use MaketrianguloTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetriangulo()
    {
        $triangulo = $this->faketrianguloData();
        $this->json('POST', '/api/v1/triangulos', $triangulo);

        $this->assertApiResponse($triangulo);
    }

    /**
     * @test
     */
    public function testReadtriangulo()
    {
        $triangulo = $this->maketriangulo();
        $this->json('GET', '/api/v1/triangulos/'.$triangulo->id);

        $this->assertApiResponse($triangulo->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetriangulo()
    {
        $triangulo = $this->maketriangulo();
        $editedtriangulo = $this->faketrianguloData();

        $this->json('PUT', '/api/v1/triangulos/'.$triangulo->id, $editedtriangulo);

        $this->assertApiResponse($editedtriangulo);
    }

    /**
     * @test
     */
    public function testDeletetriangulo()
    {
        $triangulo = $this->maketriangulo();
        $this->json('DELETE', '/api/v1/triangulos/'.$triangulo->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/triangulos/'.$triangulo->id);

        $this->assertResponseStatus(404);
    }
}

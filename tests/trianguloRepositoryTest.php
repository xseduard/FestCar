<?php

use App\Models\triangulo;
use App\Repositories\trianguloRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class trianguloRepositoryTest extends TestCase
{
    use MaketrianguloTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var trianguloRepository
     */
    protected $trianguloRepo;

    public function setUp()
    {
        parent::setUp();
        $this->trianguloRepo = App::make(trianguloRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetriangulo()
    {
        $triangulo = $this->faketrianguloData();
        $createdtriangulo = $this->trianguloRepo->create($triangulo);
        $createdtriangulo = $createdtriangulo->toArray();
        $this->assertArrayHasKey('id', $createdtriangulo);
        $this->assertNotNull($createdtriangulo['id'], 'Created triangulo must have id specified');
        $this->assertNotNull(triangulo::find($createdtriangulo['id']), 'triangulo with given id must be in DB');
        $this->assertModelData($triangulo, $createdtriangulo);
    }

    /**
     * @test read
     */
    public function testReadtriangulo()
    {
        $triangulo = $this->maketriangulo();
        $dbtriangulo = $this->trianguloRepo->find($triangulo->id);
        $dbtriangulo = $dbtriangulo->toArray();
        $this->assertModelData($triangulo->toArray(), $dbtriangulo);
    }

    /**
     * @test update
     */
    public function testUpdatetriangulo()
    {
        $triangulo = $this->maketriangulo();
        $faketriangulo = $this->faketrianguloData();
        $updatedtriangulo = $this->trianguloRepo->update($faketriangulo, $triangulo->id);
        $this->assertModelData($faketriangulo, $updatedtriangulo->toArray());
        $dbtriangulo = $this->trianguloRepo->find($triangulo->id);
        $this->assertModelData($faketriangulo, $dbtriangulo->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetriangulo()
    {
        $triangulo = $this->maketriangulo();
        $resp = $this->trianguloRepo->delete($triangulo->id);
        $this->assertTrue($resp);
        $this->assertNull(triangulo::find($triangulo->id), 'triangulo should not exist in DB');
    }
}

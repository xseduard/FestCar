<?php

use App\Models\Pruebauno;
use App\Repositories\PruebaunoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PruebaunoRepositoryTest extends TestCase
{
    use MakePruebaunoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PruebaunoRepository
     */
    protected $pruebaunoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pruebaunoRepo = App::make(PruebaunoRepository::class);
    }

    /**
     * @test create
     */
    function it_creates_pruebauno()
    {
        $pruebauno = $this->fakePruebaunoData();
        $createdPruebauno = $this->pruebaunoRepo->create($pruebauno);
        $createdPruebauno = $createdPruebauno->toArray();
        $this->assertArrayHasKey('id', $createdPruebauno);
        $this->assertNotNull($createdPruebauno['id'], 'Created Pruebauno must have id specified');
        $this->assertNotNull(Pruebauno::find($createdPruebauno['id']), 'Pruebauno with given id must be in DB');
        $this->assertModelData($pruebauno, $createdPruebauno);
    }

    /**
     * @test read
     */
    function it_reads_pruebaunos()
    {
        $pruebauno = $this->makePruebauno();
        $dbPruebauno = $this->pruebaunoRepo->find($pruebauno->id);
        $dbPruebauno = $dbPruebauno->toArray();
        $this->assertModelData($pruebauno->toArray(), $dbPruebauno);
    }

    /**
     * @test update
     */
    function it_updates_pruebauno()
    {
        $pruebauno = $this->makePruebauno();
        $fakePruebauno = $this->fakePruebaunoData();
        $updatedPruebauno = $this->pruebaunoRepo->update($fakePruebauno, $pruebauno->id);
        $this->assertModelData($fakePruebauno, $updatedPruebauno->toArray());
        $dbPruebauno = $this->pruebaunoRepo->find($pruebauno->id);
        $this->assertModelData($fakePruebauno, $dbPruebauno->toArray());
    }

    /**
     * @test delete
     */
    function it_deletes_pruebauno()
    {
        $pruebauno = $this->makePruebauno();
        $resp = $this->pruebaunoRepo->delete($pruebauno->id);
        $this->assertTrue($resp);
        $this->assertNull(Pruebauno::find($pruebauno->id), 'Pruebauno should not exist in DB');
    }
}
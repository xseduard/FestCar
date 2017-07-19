<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExcelRepositoryRepository;
use App\Entities\ExcelRepository;
use App\Validators\ExcelRepositoryValidator;

/**
 * Class ExcelRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ExcelRepositoryRepositoryEloquent extends BaseRepository implements ExcelRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ExcelRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

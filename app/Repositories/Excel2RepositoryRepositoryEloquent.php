<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Excel2RepositoryRepository;
use App\Entities\Excel2Repository;
use App\Validators\Excel2RepositoryValidator;

/**
 * Class Excel2RepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class Excel2RepositoryRepositoryEloquent extends BaseRepository implements Excel2RepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Excel2Repository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

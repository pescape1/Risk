<?php

namespace App\Repositories;

use App\Models\Operation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OperationRepository
 * @package App\Repositories
 * @version November 10, 2017, 8:33 pm UTC
 *
 * @method Operation findWithoutFail($id, $columns = ['*'])
 * @method Operation find($id, $columns = ['*'])
 * @method Operation first($columns = ['*'])
*/
class OperationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'operation',
        'description',
        'operationscol'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Operation::class;
    }
}

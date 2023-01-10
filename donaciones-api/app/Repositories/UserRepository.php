<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
/**
 * Class UserRepository
 * @package App\Repositories
*/ 

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function roles()
    {
        return Role::pluck('name','name')->all();
    }
}

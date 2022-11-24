<?php

namespace App\Repositories;

use App\Models\NewCall;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class NewCallRepository
 * @package App\Repositories
 * @version November 23, 2022, 8:20 pm UTC
*/

class NewCallRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'image'
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
        return NewCall::class;
    }

   public function listUser()
   {
        return  DB::table('users')->
                select('id', DB::raw("CONCAT(users.firstname,' ',users.lastname) AS full_name"))
                ->get()->pluck('full_name', 'id');
   }

   public function user()
   {
        return Auth::user()->id;
   }
}

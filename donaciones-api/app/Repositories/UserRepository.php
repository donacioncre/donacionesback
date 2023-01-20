<?php

namespace App\Repositories;

use App\Models\DonationPoint;
use App\Models\User;
use App\Models\UserDonationCenter;
use App\Repositories\BaseRepository;
use Exception;
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
        return  Role::pluck('name','name')->all();
    }

     public function listDonationCenter()
     {
         return DonationPoint::pluck('name','id')->all();
     }

     public function saveDonationCenter($data)
     {
        try {
            DB::beginTransaction();
            $user= UserDonationCenter::create($data);
            DB::commit();
            return $user;
            
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }

       
     }

     public function updateDonationCenter($data)
     {
        try {
            DB::beginTransaction();
            $user= UserDonationCenter::where('user_id',$data['user_id'])->delete();
            $user= UserDonationCenter::create($data);
            DB::commit();
            return $user;
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
     }

     public function listUserDonors()
     {
        return   User::whereHas("roles", function($q){ $q->where("name", "donante"); })->get();
     }

     public function listUserRol()
     {
        return   User::whereHas("roles", function($q){ $q->where("name","!=", "donante"); })->get();
     }
}

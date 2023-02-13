<?php

namespace App\Repositories;


use App\Models\MythDetails;
use App\Models\Myths;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BenefitDonatingRepository
 * @package App\Repositories
 * @version November 16, 2022, 10:16 pm UTC
*/
 
class MythRepository extends BaseRepository
{
     /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details'
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
        return Myths::class;
    }

    public function list()
    {
        return Myths::with('myth_details')->get();
    }

   
    public function store($data)
    {
        
        try {
            DB::beginTransaction();
            $myth = Myths::create($data);

            foreach($data['details_myth'] as $key=> $value){

                MythDetails::create([
                    'myths_id' => $myth->id,
                    'ask' => $value['ask'],
                    'answer' => $value['answer'],
                    'image' => $value['image'],
                ]);
            }

            DB::commit();
            
            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
 

       
    }

    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $data= Myths::find($id);
            $data->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return Myths::with('myth_details')->find($id);
    }

}

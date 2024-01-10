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

            return $myth->id;
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }



    }

    public function update($data,$id)
    {
        try {
            $image=[];
            DB::beginTransaction();
            $myth= Myths::find($id);
            $myth->update($data);

            $details = MythDetails::where('myths_id',$myth->id)->get();
            MythDetails::where('myths_id',$myth->id)->delete();

            foreach ($details as $key => $value) {
                $image[]=[$value->image];
            }

            foreach($data['item'] as $key1=> $item){
                if ($item['ask'] !== null && $item['answer'] !== null   ) {
                    MythDetails::create([
                        'myths_id' => $myth->id,
                        'ask' => $item['ask'],
                        'answer' => $item['answer'],
                        'image' => $item['image'] != null ?  $item['image'] : $image[$key1][0],
                    ]);
                }

            }

            DB::commit();
            return 'ok';

        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function addPoints($data,$id)
    {
        try {
            DB::beginTransaction();
            $myth= Myths::find($id);
            foreach($data['item'] as $key1=> $item){
                if ($item['ask'] !== null && $item['answer'] !== null   ) {
                    MythDetails::create([
                        'myths_id' => $id,
                        'ask' => $item['ask'],
                        'answer' => $item['answer'],
                        'image' => $item['image'],
                    ]);
                }

            }


            DB::commit();
            return $myth;

        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function deleteDetails($id)
    {
        try {
            DB::beginTransaction();
           $details =  MythDetails::find($id);
           $data = $details->myths_id;
           $details->delete();
            DB::commit();
            return $data;

        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return Myths::with('myth_details')->orderBy('id', 'desc')->first();
    }

}

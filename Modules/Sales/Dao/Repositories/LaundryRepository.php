<?php

namespace Modules\Sales\Dao\Repositories;

use Plugin\Notes;
use Plugin\Helper;
use Modules\Sales\Dao\Models\Laundry;
use App\Dao\Interfaces\MasterInterface;
use App\Dao\Models\User;
use Illuminate\Database\QueryException;
use Modules\Crm\Dao\Facades\CustomerFacades;
use Modules\Sales\Dao\Facades\LaundryDetailFacades;
use Modules\Sales\Dao\Models\LaundryDetail;

class LaundryRepository extends Laundry implements MasterInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable, $this->getKeyName());
        return $this->select($list)
        ->leftJoin('users', 'id', 'laundry_user_id')
        ->leftJoin(CustomerFacades::getTable(), CustomerFacades::getKeyName(), 'laundry_customer_id');
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->create($request);
            return Notes::create($activity);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($id, $request)
    {
        try {
            $activity = $this->findOrFail($id)->update($request);
            return Notes::update($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($data)
    {
        try {
            $activity = $this->Destroy(array_values($data));
            return Notes::delete($activity);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteDetailRepository($primary, $foreign)
    {
        $detail = new LaundryDetail();

        try {
            $activity =  $detail->where($detail->getKeyName(), $primary)
        ->where($detail->getForeignKey(), $foreign)->delete();

            
            return Notes::delete($activity);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function showRepository($id, $relation = false)
    {
        if ($relation) {
            return $this->with($relation)->findOrFail($id);
        }
        return $this->findOrFail($id);
    }
}

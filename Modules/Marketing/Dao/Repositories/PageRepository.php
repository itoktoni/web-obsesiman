<?php

namespace Modules\Marketing\Dao\Repositories;

use Plugin\Notes;
use Plugin\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Modules\Marketing\Dao\Models\Page;
use App\Dao\Interfaces\MasterInterface;
use Illuminate\Database\QueryException;

class PageRepository extends Page implements MasterInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable, $this->getKeyName());
        return $this->select($list);
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

    public function slugRepository($slug, $relation = false)
    {
        if ($relation) {
            return $this->with($relation)->where('marketing_page_slug', $slug)->firstOrFail();
        }
        return $this->where('marketing_page_slug', $slug)->firstOrFail();
    }

    public function showRepository($id, $relation = false)
    {
        if ($relation) {
            return $this->with($relation)->findOrFail($id);
        }
        return $this->findOrFail($id);
    }

      public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            $file = 'marketing_page_file';
            if (request()->has($file)) {
                $image = $model->marketing_page_image;
                if ($image) {
                    Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->marketing_page_image = $name;
            }

            if ($model->marketing_page_name && empty($model->marketing_page_slug)) {
                $model->marketing_page_slug = Str::slug($model->marketing_page_name);
            }
        });

        parent::deleting(function ($model) {
            if (request()->has('id')) {
                $data = $model->getDataIn(request()->get('id'));
                if ($data) {
                    foreach ($data as $value) {
                        Helper::removeImage($value->marketing_page_image, Helper::getTemplate(__CLASS__));
                    }
                }
            }
        });
    }

}

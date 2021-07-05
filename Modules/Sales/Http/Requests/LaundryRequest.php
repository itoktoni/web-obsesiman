<?php

namespace Modules\Sales\Http\Requests;

use Plugin\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Sales\Dao\Repositories\LaundryRepository;

class LaundryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private static $model;

    public function __construct(LaundryRepository $models)
    {
        self::$model = $models;
    }

    public function prepareForValidation()
    {
        $autonumber = Helper::autoNumber(self::$model->getTable(), self::$model->getKeyName(), 'DO' . date('Ym'), config('website.autonumber'));
        if (!empty($this->code)) {
            $autonumber = $this->code;
        }
        $map = collect($this->detail)->map(function ($item) use ($autonumber) {

            $data['laundry_detail_id'] = $autonumber;
            $data['laundry_detail_product_id'] = $item['temp_id'];
            $data['laundry_detail_product_name'] = $item['temp_product'];
            $data['laundry_detail_notes'] = $item['temp_notes'] ?? '';
            $data['laundry_detail_kotor'] = Helper::filterInput($item['temp_qty']);
            $data['laundry_detail_bersih'] = Helper::filterInput($item['temp_price']) ?? 0;
            return $data;
        });

        $this->merge([
            'laundry_id' => $autonumber,
            'laundry_user_id' => auth()->user()->id,
            'detail' => array_values($map->toArray()),
        ]);
    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'laundry_customer_id' => 'required',
                'laundry_status' => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            'sales_order_from_id' => 'Company',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !',
        ];
    }
}

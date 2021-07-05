<?php

namespace Modules\Sales\Http\Controllers;

use Plugin\Helper;
use Plugin\Response;
use Barryvdh\DomPDF\PdfFacade;
use App\Http\Controllers\Controller;
use App\Http\Services\MasterService;
use App\Dao\Repositories\CompanyRepository;
use Modules\Sales\Http\Services\OrderService;
use Modules\Sales\Http\Requests\LaundryRequest;
use Modules\Sales\Http\Services\LaundryService;
use Modules\Item\Dao\Repositories\TagRepository;
use Modules\Sales\Http\Requests\DeliveryRequest;
use Modules\Finance\Dao\Repositories\TaxRepository;
use Modules\Finance\Dao\Repositories\TopRepository;
use Modules\Crm\Dao\Repositories\CustomerRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Sales\Dao\Repositories\LaundryRepository;
use Modules\Sales\Dao\Repositories\DeliveryRepository;
use Modules\Finance\Dao\Repositories\PaymentRepository;
use Modules\Marketing\Dao\Repositories\PromoRepository;

class LaundryController extends Controller
{
    public $template;
    public static $model;
    public static $delivery;
    public $folder;

    public function __construct()
    {
        if (self::$model == null) {
            self::$model = new LaundryRepository();
            self::$delivery = new DeliveryRepository();
        }
        $this->template = Helper::getTemplate(__CLASS__);
        $this->folder = 'sales';
    }

    public function index()
    {
        return redirect()->route($this->getModule() . '_data');
    }

    private function share($data = [])
    {
        $tops = Helper::shareOption((new TopRepository()));
        $product = Helper::shareOption((new ProductRepository()),false)->prepend('- Masukan Nama Linen -', '');
        $tag = Helper::shareOption((new TagRepository()),false, true)->pluck('item_tag_name', 'item_tag_name')->prepend('- Keterangan - ','');
        $promo = Helper::shareOption((new PromoRepository()));
        $company = Helper::shareOption((new CompanyRepository()));
        $customers = Helper::shareOption((new CustomerRepository()),false)->prepend(' - Masukan Rumah Sakit -', '');
        $status = Helper::shareStatus(self::$model->status);

        $from = $to = ['Please Choose Area'];

        $view = [
            'key' => self::$model->getKeyName(),
            'template' => $this->template,
            'tag' => $tag,
            'tops' => $tops,
            'product' => $product,
            'status' => $status,
            'promo' => $promo,
            'from' => $from,
            'to' => $to,
            'company' => $company,
            'customers' => $customers,
        ];

        return array_merge($view, $data);
    }

    public function create(LaundryService $service, LaundryRequest $request)
    {
        if (request()->isMethod('POST')) {
            $data = $service->save(self::$model, $request->all());
            return redirect()->route('sales_laundry_update', ['code' => $data['data']->laundry_id]);
        }
        return view(Helper::setViewSave($this->template, $this->folder))->with($this->share([
            'model' => self::$model,
        ]));
    }

    public function update(LaundryService $service, LaundryRequest $request)
    {
        if (request()->isMethod('POST')) {
            $data = $service->update(self::$model, $request->all());
            $data = $request->all();
            return Response::redirectBack($data);
        }

        $data = $service->show(self::$model);
        return view(Helper::setViewSave($this->template, $this->folder))->with($this->share([
            'model' => $data,
            'detail' => $data->detail,
        ]));
    }

    public function delivery(OrderService $service, DeliveryRequest $request)
    {
        if (request()->isMethod('POST')) {
            $data = $service->delivery(self::$delivery, $request->all());
            return Response::redirectBack($data);
        }

        $data = $service->show(self::$model);
        $from = Helper::getSingleArea($data->company->company_delivery_rajaongkir_area_id ?? '');
        $to = Helper::getSingleArea($data->customer->crm_customer_delivery_rajaongkir_area_id);

        return view(Helper::setViewForm($this->template, __FUNCTION__, $this->folder))->with($this->share([
            'model' => $data,
            'from' => $from,
            'to' => $to,
            'detail' => $data->detail,
        ]));
    }

    public function delete(MasterService $service)
    {
        if (request()->has('code') && request()->has('detail')) {
            $code = request()->get('code');
            $detail = request()->get('detail');
            self::$model->deleteDetailRepository($code, $detail);
        }

        $service->delete(self::$model);
        return Response::redirectBack();
    }

    public function data(MasterService $service)
    {
        if (request()->isMethod('POST')) {
            $datatable = $service->setRaw(['laundry_status'])->datatable(self::$model);
            $datatable->editColumn('laundry_date', function ($model) {
                return $model->laundry_date->isoFormat('dddd, d MMMM Y');
            });
            $datatable->editColumn('laundry_status', function ($select) {
                return Helper::createStatus([
                    'value' => $select->laundry_status,
                    'status' => self::$model->status,
                ]);
            });

            return $datatable->make(true);
        }

        return view(Helper::setViewData())->with([
            'fields' => Helper::listData(self::$model->datatable),
            'template' => $this->template,
        ]);
    }

    public function show(MasterService $service)
    {
        $data = $service->show(self::$model);
        $field = Helper::listData(self::$model->datatable);
        unset($field['sales_order_status']);
        unset($field['rajaongkir_paket_name']);
        unset($field['finance_top_name']);
        $payment = PaymentRepository::where('finance_payment_sales_order_id', $data->sales_order_id)->get();
        return view(Helper::setViewShow())->with($this->share([
            'fields' => $field,
            'payment' => $payment,
            'model' => $data,
            'key' => self::$model->getKeyName(),
        ]));
    }

    public function print_order(MasterService $service)
    {
        if (request()->has('code')) {
            $data = $service->show(self::$model);
            $id = request()->get('code');
            $pasing = [
                'master' => $data,
                'detail' => $data->detail,
            ];
            if(request()->get('type') == 'A4'){
                $pdf = PdfFacade::loadView(Helper::setViewPrint(__FUNCTION__.'a4', $this->folder), $pasing)->setPaper('A4', 'potrait');
            }
            else if(request()->get('type') == 'F4'){
                $pdf = PdfFacade::loadView(Helper::setViewPrint(__FUNCTION__.'f4', $this->folder), $pasing)->setPaper(array(0,0,595.276, 935.433));
            }
            else{

                $pdf = PdfFacade::loadView(Helper::setViewPrint(__FUNCTION__, $this->folder), $pasing)->setPaper(array(0,0,609.4488, 389.76378));
            }

            return $pdf->stream();
        }
    }
}

<?php

namespace Modules\Sales\Dao\Repositories\report;

use Plugin\Notes;
use Plugin\Helper;
use App\Dao\Models\Branch;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Models\Brand;
use Modules\Item\Dao\Models\Color;
use Modules\Item\Dao\Models\Stock;
use Illuminate\Contracts\View\View;
use Modules\Sales\Dao\Models\Order;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\Category;
use App\Dao\Interfaces\MasterInterface;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Sales\Dao\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Rajaongkir\Dao\Models\Delivery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Modules\Item\Dao\Repositories\StockRepository;
use Modules\Procurement\Dao\Models\PurchaseDetail;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;

class ReportDetailOrderRepository extends Order implements FromView, ShouldAutoSize
{
    public $model;
    public $detail;
    public $product;
    public $branch;
    public $key = [];

    public function __construct()
    {
        $this->model = new OrderRepository();
        $this->detail = new OrderDetail();
        $this->product = new Product();
        $this->category = new Category();
        $this->branch = new Branch();
    }

    public function view(): View
    {
        $query = $this->model
        ->leftJoin($this->branch->getTable(), 'sales_order_from_id', $this->branch->getKeyName())
        ->leftJoin($this->delivery->getTable(), 'sales_order_delivery_type', $this->delivery->getKeyName())
        ->leftJoin($this->detail->getTable(), $this->model->getKeyName(), 'sales_order_detail_order_id')
        ->leftJoin($this->product->getTable(), 'sales_order_detail_item_product_id', $this->product->getKeyName())
        ->leftJoin($this->category->getTable(), 'item_product_item_category_id', $this->category->getKeyName())
            ->select([
                'sales_order_id',
                'sales_order_created_at',
                'sales_order_created_by',
                'sales_order_updated_at',
                'sales_order_updated_by',
                'sales_order_deleted_at',
                'sales_order_deleted_by',
                'sales_order_code_reference',
                'sales_order_code_po',
                'sales_order_code_quotation',
                'sales_order_date_order',
                'sales_order_date_quotation',
                'sales_order_from_id',
                'sales_order_from_name',
                'sales_order_from_phone',
                'sales_order_from_email',
                'sales_order_from_address',
                'sales_order_from_area',
                'sales_order_to_id',
                'sales_order_to_name',
                'sales_order_to_phone',
                'sales_order_to_email',
                'sales_order_to_address',
                'sales_order_to_area',
                'sales_order_status',
                'sales_order_term_top',
                'sales_order_term_product',
                'sales_order_term_valid',
                'sales_order_notes_internal',
                'sales_order_notes_external',
                'sales_order_discount_name',
                'sales_order_discount_percent',
                'sales_order_discount_value',
                'sales_order_tax_id',
                'sales_order_tax_percent',
                'sales_order_tax_value',
                'sales_order_sum_product',
                'sales_order_sum_discount',
                'sales_order_sum_tax',
                'sales_order_sum_ongkir',
                'sales_order_sum_total',
                'sales_order_attached_po',
                'sales_order_payment_date',
                'sales_order_payment_bank_from',
                'sales_order_payment_bank_to_id',
                'sales_order_payment_person',
                'sales_order_payment_phone',
                'sales_order_payment_email',
                'sales_order_payment_file',
                'sales_order_payment_value',
                'sales_order_payment_notes',
                'sales_order_delivery_type',
                'sales_order_delivery_name',
                'sales_order_print_counter',
                'sales_order_core_user_id',
                'branch_name',
                'rajaongkir_delivery_name',
                'sales_order_delivery_name',
                'item_category_name',
                'item_product.*',
                'sales_order_detail.*',
            ]);

        if ($promo = request()->get('promo')) {
            $query->where('sales_order_marketing_promo_code', $promo);
        }
        if ($status = request()->get('status')) {
            $query->where('sales_order_status', $status);
        }
        if ($from = request()->get('from')) {
            $query->where('sales_order_date_order', '>=', $from);
        }
        if ($to = request()->get('to')) {
            $query->where('sales_order_date_order','<=', $to);
        }

        $query = $query->orderBy($this->model->getKeyName(), 'ASC');
        return view('Sales::page.report.export_detail', [
            'export' => $query->get()
        ]);
    }
}

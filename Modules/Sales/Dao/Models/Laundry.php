<?php

namespace Modules\Sales\Dao\Models;

use App\Dao\Models\User;
use Illuminate\Support\Str;
use Modules\Crm\Dao\Models\Customer;
use Illuminate\Support\Facades\Cache;
use App\Dao\Dimentions\BranchDimention;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Dao\Models\LaundryDetail;

class Laundry extends Model
{
  protected $table = 'laundry';
  protected $with = ['detail'];
  protected $primaryKey = 'laundry_id';
  protected $fillable = [
    'laundry_id',
    'laundry_date',
    'laundry_created_date',
    'laundry_updated_date',
    'laundry_customer_id',
    'laundry_status',
    'laundry_user_id',
  ];

  public $timestamps = true;
  public $incrementing = false;
  public $rules = [
    'laundry_date' => 'required|min:3',
  ];

  protected $dates = [
    'laundry_date',
  ];

  const CREATED_AT = 'laundry_created_date';
  const UPDATED_AT = 'laundry_updated_date';
  public $searching = 'laundry_name';
  public $datatable = [
    'laundry_id'             => [true => 'Nomer DO'],
    'name'           => [true => 'Pembuat'],
    'laundry_date'           => [true => 'Tanggal'],
    'crm_customer_name'           => [true => 'Nama Customer'],
    'laundry_status'           => [true => 'Status'],
  ];

  public $status = [
    '1' => ['Aktif', 'primary'],
    '0' => ['Tidak Aktif', 'danger'],
  ];

  public static function boot()
  {
    parent::boot();
  }


  public function detail()
  {
      return $this->hasMany(LaundryDetail::class, 'laundry_detail_id', 'laundry_id');
  }

  public function customer()
  {
      return $this->hasOne(Customer::class, 'crm_customer_id', 'laundry_customer_id');
  }

  public function user()
  {
      return $this->hasOne(User::class, 'id', 'laundry_user_id');
  }

}

<?php

namespace Modules\Sales\Dao\Models;

use Modules\Item\Dao\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\Rajaongkir\Dao\Models\Area;

class LaundryDetail extends Model
{
  protected $table = 'laundry_detail';
  protected $primaryKey = 'laundry_detail_id';
  protected $foreignKey = 'laundry_detail_product_id';
  protected $fillable = [
    'laundry_detail_id',
    'laundry_detail_kotor',
    'laundry_detail_product_name',
    'laundry_detail_product_id',
    'laundry_detail_bersih',
    'laundry_detail_bersih',
  ];

  public $timestamps = false;
  public $incrementing = false;

  public function getForeignKey()
  {
      return $this->foreignKey;
  }

  public function detail()
  {
    return $this->belongsTo(Order::class, 'laundry_detail_id', 'laundry_id');
  }

  public function product()
  {
    return $this->hasOne(Product::class, 'item_product_id', 'laundry_detail_item_product_id');
  }

}

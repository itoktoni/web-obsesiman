<?php

namespace Modules\Marketing\Dao\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'marketing_page';
  protected $primaryKey = 'marketing_page_id';
  protected $fillable = [
    'marketing_page_id',
    'marketing_page_name',
    'marketing_page_slug',
    'marketing_page_link',
    'marketing_page_image',
    'marketing_page_button',
    'marketing_page_status',
    'marketing_page_description',
    'marketing_page_created_at',
    'marketing_page_updated_at',
    'marketing_page_created_by',
  ];

  public $timestamps = true;
  public $incrementing = true;
  public $rules = [
    'marketing_page_name' => 'required|min:3|unique:marketing_page',
  ];

  const CREATED_AT = 'marketing_page_created_at';
  const UPDATED_AT = 'marketing_page_updated_at';

  public $searching = 'marketing_page_name';
  public $datatable = [
    'marketing_page_id'          => [false => 'ID'],
    'marketing_page_name'        => [true => 'Name'],
    'marketing_page_slug'        => [true => 'Slug'],
    'marketing_page_image'        => [true => 'Slug'],
    'marketing_page_link'        => [false => 'Link'],
    'marketing_page_button'        => [false => 'Button'],
    'marketing_page_description'        => [true => 'Description'],
    'marketing_page_created_at'  => [false => 'Created At'],  
    'marketing_page_created_by'  => [false => 'Created By'],  
    'marketing_page_status'        => [false => 'Status'],
  ];

  public $status = [
    '1' => ['Active', 'primary'],
    '0' => ['Not Active', 'danger'],
  ];
}

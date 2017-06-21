<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The model for all products
 * 
 * @var string sku The product SKU, a unique value
 * @var string title The product name
 * @var float price The retail value
 * @var string description A brief description
 * @var string color The product color
 * @var string dimensions The product dimensions
 *
 */
class Product extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
			'id', 'created_at', 'updated_at'
	];
}

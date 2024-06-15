<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discount
 * 
 * @property int $DiscountID
 * @property int|null $DishID
 * @property float|null $DiscountPercentage
 * @property Carbon|null $StartDate
 * @property Carbon|null $EndDate
 * 
 * @property Dish|null $dish
 *
 * @package App\Models
 */
class Discount extends Model
{
	protected $table = 'discounts';
	protected $primaryKey = 'DiscountID';
	public $timestamps = false;

	protected $casts = [
		'DishID' => 'int',
		'DiscountPercentage' => 'float',
		'StartDate' => 'datetime',
		'EndDate' => 'datetime'
	];

	protected $fillable = [
		'DishID',
		'DiscountPercentage',
		'StartDate',
		'EndDate'
	];

	public function dish()
	{
		return $this->belongsTo(Dish::class, 'DishID');
	}
}

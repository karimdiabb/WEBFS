<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dish
 * 
 * @property int $DishID
 * @property string|null $DishName
 * @property float|null $Price
 * @property string|null $Description
 * @property int|null $DishTypeID
 * 
 * @property DishType|null $dish_type
 * @property Collection|Discount[] $discounts
 * @property Collection|MenuItem[] $menu_items
 *
 * @package App\Models
 */
class Dish extends Model
{
	protected $table = 'dishes';
	protected $primaryKey = 'DishID';
	public $timestamps = false;

	protected $casts = [
		'Price' => 'float',
		'DishTypeID' => 'int'
	];

	protected $fillable = [
		'DishName',
		'Price',
		'Description',
		'DishTypeID'
	];

	public function dish_type()
	{
		return $this->belongsTo(DishType::class, 'DishTypeID');
	}

	public function discounts()
	{
		return $this->hasMany(Discount::class, 'DishID');
	}

	public function menu_items()
	{
		return $this->hasMany(MenuItem::class, 'DishID');
	}
}

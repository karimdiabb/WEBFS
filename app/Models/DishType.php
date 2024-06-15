<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DishType
 * 
 * @property int $DishTypeID
 * @property string|null $DishTypeName
 * 
 * @property Collection|Dish[] $dishes
 *
 * @package App\Models
 */
class DishType extends Model
{
	protected $table = 'dish_type';
	protected $primaryKey = 'DishTypeID';
	public $timestamps = false;

	protected $fillable = [
		'DishTypeName'
	];

	public function dishes()
	{
		return $this->hasMany(Dish::class, 'DishTypeID');
	}
}

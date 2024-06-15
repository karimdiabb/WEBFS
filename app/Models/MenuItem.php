<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuItem
 * 
 * @property int $MenuItemID
 * @property int|null $MenuID
 * @property int|null $DishID
 * @property int|null $ItemNumber
 * @property string|null $ExtraIdentifier
 * 
 * @property Menu|null $menu
 * @property Dish|null $dish
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class MenuItem extends Model
{
	protected $table = 'menu_items';
	protected $primaryKey = 'MenuItemID';
	public $timestamps = false;

	protected $casts = [
		'MenuID' => 'int',
		'DishID' => 'int',
		'ItemNumber' => 'int'
	];

	protected $fillable = [
		'MenuID',
		'DishID',
		'ItemNumber',
		'ExtraIdentifier'
	];

	public function menu()
	{
		return $this->belongsTo(Menu::class, 'MenuID');
	}

	public function dish()
	{
		return $this->belongsTo(Dish::class, 'DishID');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'MenuItemID');
	}
}

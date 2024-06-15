<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TableSession
 * 
 * @property int $SessionID
 * @property int $TableID
 * @property string|null $Person_birthdates
 * @property bool|null $Deluxe_menu
 * 
 * @property RestaurantTable $restaurant_table
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class TableSession extends Model
{
	protected $table = 'table_sessions';
	protected $primaryKey = 'SessionID';
	public $timestamps = false;

	protected $casts = [
		'TableID' => 'int',
		'Deluxe_menu' => 'bool'
	];

	protected $fillable = [
		'TableID',
		'Person_birthdates',
		'Deluxe_menu'
	];

	public function restaurant_table()
	{
		return $this->belongsTo(RestaurantTable::class, 'TableID');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'SessionID');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RestaurantTable
 * 
 * @property int $TableID
 * @property string|null $Name
 * 
 * @property Collection|TableSession[] $table_sessions
 *
 * @package App\Models
 */
class RestaurantTable extends Model
{
	protected $table = 'restaurant_tables';
	protected $primaryKey = 'TableID';
	public $timestamps = false;

	protected $fillable = [
		'Name'
	];

	public function table_sessions()
	{
		return $this->hasMany(TableSession::class, 'TableID');
	}
}

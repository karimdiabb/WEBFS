<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * 
 * @property int $MenuID
 * @property string|null $MenuName
 * 
 * @property Collection|MenuItem[] $menu_items
 *
 * @package App\Models
 */
class Menu extends Model
{
	protected $table = 'menu';
	protected $primaryKey = 'MenuID';
	public $timestamps = false;

	protected $fillable = [
		'MenuName'
	];

	public function menu_items()
	{
		return $this->hasMany(MenuItem::class, 'MenuID');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 *
 * @property int $OrderItemID
 * @property int $OrderID
 * @property int $MenuItemID
 * @property int|null $Quantity
 * @property float|null $ItemPrice
 * @property string|null $Note
 *
 * @property Order $order
 * @property MenuItem $menu_item
 *
 * @package App\Models
 */
class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'OrderItemID';
    public $timestamps = false;

    protected $casts = [
        'OrderID' => 'int',
        'MenuItemID' => 'int',
        'Quantity' => 'int',
        'ItemPrice' => 'float'
    ];

    protected $fillable = [
        'OrderID',
        'MenuItemID',
        'Quantity',
        'ItemPrice',
        'Note'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }

    public function menu_item()
    {
        return $this->belongsTo(MenuItem::class, 'MenuItemID');
    }
}

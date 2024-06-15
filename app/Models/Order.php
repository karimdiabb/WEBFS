<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $OrderID
 * @property int $SessionID
 * @property Carbon|null $OrderTime
 * @property float|null $TotalPrice
 * @property bool|null $ReorderFlag
 * @property string|null $Notes

 * @property TableSession $table_session
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

    protected $casts = [
        'SessionID' => 'int',
        'OrderTime' => 'datetime',
        'TotalPrice' => 'float',
        'ReorderFlag' => 'bool'
    ];

    protected $fillable = [
        'SessionID',
        'OrderTime',
        'TotalPrice',
        'ReorderFlag',
        'Notes'

    ];

    public function table_session()
    {
        return $this->belongsTo(TableSession::class, 'SessionID');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'OrderID');
    }
}

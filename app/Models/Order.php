<?php
/**
 * Created by PhpStorm.
 * User: katyn
 * Date: 31.01.2017
 * Time: 13:19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'quantity',
        'user_id',
        'product_id'
    ];

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
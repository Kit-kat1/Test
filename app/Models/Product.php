<?php
/**
 * Created by PhpStorm.
 * User: katyn
 * Date: 31.01.2017
 * Time: 13:19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'price'
    ];
}
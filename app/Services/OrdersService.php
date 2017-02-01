<?php
namespace App\Services;

use App\Models\Order;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OrdersService
 * @package App\Services
 */
class OrdersService
{
    public $fetchFields = [
        'products.name as product',
        'users.name as user',
        'orders.date',
        'products.price',
        'orders.quantity'
    ];

    /**
     * Get orders by interval.
     *
     * @param string $interval
     *
     * @return Collection
     */
    public function getOrdersBy($interval)
    {
        switch ($interval)
        {
            case 'today':
                $orders = $this->getTodayOrders();
                break;
            case 'week':
                $orders = $this->getWeekOrders();
                break;
            default:
                $orders = Order::join('users', 'users.id', 'orders.user_id')
                    ->join('products', 'products.id', 'orders.product_id')
                    ->get($this->fetchFields);
        }

        return $orders;
    }

    /**
     * Get today orders.
     *
     * @return Collection
     */
    public function getTodayOrders()
    {
        return Order::join('users', 'users.id', 'orders.user_id')
            ->join('products', 'products.id', 'orders.product_id')
            ->where('date', date('Y-m-d'))
            ->get($this->fetchFields);
    }

    /**
     * Get this week orders by interval.
     *
     * @return Collection
     */
    public function getWeekOrders()
    {
        $date = new DateTime();

        return Order::join('users', 'users.id', 'orders.user_id')
            ->join('products', 'products.id', 'orders.product_id')
            ->whereBetween('date', [$date->modify('-7 days'), date('Y-m-d')])
            ->get($this->fetchFields);
    }

    /**
     * Filter orders by user|product
     *
     * @param $key
     * @param $type
     *
     * @return bool|Collection
     */
    public function filterBy($key, $type)
    {
        if (in_array($type, ['users', 'products'])) {
            return Order::join('users', 'users.id', 'orders.user_id')
                ->join('products', 'products.id', 'orders.product_id')
                ->where($type . '.name', 'like', $key . '%')
                ->get($this->fetchFields);
        }

        return false;
    }
}
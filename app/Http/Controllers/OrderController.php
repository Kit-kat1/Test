<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrdersService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * OrdersService instance
     *
     * @var OrdersService $ordersService
     */
    protected $ordersService;

    /**
     * OrderController constructor.
     *
     * @param OrdersService $ordersService
     */
    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * Show orders table
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('main', [
            'orders' => Order::all(),
            'users' => User::all(),
            'products' => Product::all()
        ]);
    }

    /**
     * Create order
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $quantity = $data['quantity'] ?: 1;

        $order = new Order([
            'quantity' => $quantity,
            'user_id' => $data['user'],
            'product_id' => $data['product'],
            'date' => date('Y-m-d')
        ]);

        $order->save();

        return redirect()->back();
    }

    /**
     * Delete order
     *
     * @param $id
     *
     * @return ResponseFactory|Response
     */
    public function delete($id)
    {
        if ($order = Order::find($id)) {
            $order->delete();

            return response('Order has been deleted!', 200);
        }

        return response('Order not found!', 404);
    }

    /**
     * Update order
     *
     * @param $id
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $quantity = $request->get('quantity');

        if ($quantity && $order = Order::find($id)) {
            $order->quantity = $request->get('quantity');
            $order->date = date('Y-m-d');
            $order->save();
        }

        return redirect()->back();
    }

    /**
     * Get orders by date interval
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function getOrders(Request $request)
    {
        if ($interval = $request->get('interval')) {
            return $this->ordersService->getOrdersBy($interval);
        }

        return Order::join('users', 'users.id', 'orders.user_id')
            ->join('products', 'products.id', 'orders.product_id')
            ->get($this->ordersService->fetchFields);
    }

    /**
     * Filter orders by user|product
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function filter(Request $request)
    {
        $key = $request->get('key');
        $type = $request->get('type');

        if ($key && $type) {
            $orders = $this->ordersService->filterBy($key, $type);

            if ($orders) {
                return $orders;
            }
        }

        return Order::join('users', 'users.id', 'orders.user_id')
            ->join('products', 'products.id', 'orders.product_id')
            ->get($this->ordersService->fetchFields);
    }
}

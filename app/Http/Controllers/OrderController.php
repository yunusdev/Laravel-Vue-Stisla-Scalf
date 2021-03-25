<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Contracts\CartContract;
use App\Contracts\OrderContract;
use App\Contracts\OrderItemContract;
use App\Contracts\ProductContract;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //

    private $orderRepository, $orderItemRepository, $cartRepository, $productRepository, $accountRepository;

    public function __construct(OrderContract $orderRepository, ProductContract $productRepository, AccountContract $accountRepository,
                                OrderItemContract $orderItemRepository, CartContract  $cartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->productRepository = $productRepository;
        $this->accountRepository = $accountRepository;

    }

    public function getUserOrders(){

        return $this->orderRepository->getUserOrders();

    }

    public function index(){

        $data['trending_products'] = $this->productRepository->getTrendingProducts();
        return view('account.orders.index')->with($data);

    }

    public function show($tracking_number){

        $data['order'] = $this->orderRepository->getOrderByTrackingNumber($tracking_number, ['orderItems.product']);
        return view('account.orders.show')->with($data);

    }

    public function create(OrderRequest $request){

        try{

            DB::beginTransaction();

            $inOrder = $request['order'];
            $inOrderItems = $request['items'];

            $order = $this->orderRepository->createUserOrder($inOrder);
            if (!Auth::guest()) $this->accountRepository->updateOrCreateUserAddress($inOrder);
            $orderItems = $this->orderItemRepository->createOrderItems($order, $inOrderItems);
            $this->cartRepository->clearUserCart();
            Cache::put('message_success', 'Order completed successfully!', now()->addSeconds(10));

            DB::commit();

            return response()->json([
                'order' => $order,
                'order_items' => $orderItems

            ]);

        }catch (\Throwable $throwable){

            DB::rollback();

            throw $throwable;
        }

    }

}

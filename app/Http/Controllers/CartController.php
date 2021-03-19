<?php

namespace App\Http\Controllers;

use App\Contracts\CartContract;
use App\Contracts\ProductContract;
use App\Http\Requests\AddItemsToCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends BaseController
{
    //
    private $cartRepository, $productRepository;

    public function __construct(CartContract $cartRepository, ProductContract $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;

    }

    public function index(){

        $data['trending_products'] = $this->productRepository->getTrendingProducts();
        return view('shop.cart')->with($data);

    }

    public function getUserCartItems(){

        $totalCartAmt = $this->cartRepository->getUserCartTotalAmount();
        $items =  $this->cartRepository->getUserCartItems(auth()->id(), ['product']);

        return response()->json([
            'total_price' => $totalCartAmt,
            'items' => $items,
        ]);

    }

    public function addItemsToCart(AddItemsToCartRequest $request){
        try {

            DB::beginTransaction();

                $cartItems = [];
                $items = $request['items'];

            foreach ($items as $item){
                $item['amount'] = $item['product_price'] * $item['quantity'];
                $cart = $this->cartRepository->addItemToCart($item);
                $cart = $this->cartRepository->getCartItemById($cart->id, ['product']);
                array_push($cartItems, $cart);
            }
            DB::commit();
            $totalCartAmt = $this->cartRepository->getUserCartTotalAmount();
            return response()->json([
                'total_price' => $totalCartAmt,
                'items' => $cartItems,
            ]);

        }catch (\Throwable $throwable){
            DB::rollback();
            throw $throwable;
        }

    }

    public function removeItem(Request $request, $item){

        $this->cartRepository->removeItemFromCart($item);

        $totalCartAmt = $this->cartRepository->getUserCartTotalAmount();

        return response()->json([
            'total_price' => $totalCartAmt,
        ]);

    }

    public function clearCart(Request $request){

        $this->cartRepository->clearUserCart();
        return response()->json([
            'message' => 'Cart cleared successfully!',
        ]);

    }
}

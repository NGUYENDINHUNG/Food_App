<?php

namespace App\Livewire\Client;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Food;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;



class AddToCart extends Component
{
    public $food;
    public $quantity = 1;

    public function mount($food)
    {
        $this->food = $food;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Vui lòng đăng nhập để mua hàng');
            return redirect()->route('auth.login');
        }

        // Kiểm tra tồn kho
        if ($this->food->quantity < $this->quantity) {
            session()->flash('error', 'Không đủ hàng trong kho. Chỉ còn ' . $this->food->quantity . ' sản phẩm.');
            return;
        }

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartDetail = $cart->cartDetails()->where('food_id', $this->food->id)->first();

        if ($cartDetail) {
            $newQuantity = $cartDetail->quantity + $this->quantity;

            // Kiểm tra tồn kho cho tổng số lượng
            if ($this->food->quantity < $newQuantity) {
                session()->flash('error', 'Không đủ hàng trong kho. Chỉ có thể thêm tối đa ' . ($this->food->quantity - $cartDetail->quantity) . ' sản phẩm nữa.');
                return;
            }

            $cartDetail->update(['quantity' => $newQuantity]);
        } else {
            $cart->cartDetails()->create([
                'food_id' => $this->food->id,
                'quantity' => $this->quantity,
                'unit_price' => $this->food->price
            ]);
        }

        session()->flash('success', 'Đã thêm vào giỏ hàng');
        $this->quantity = 1; // Reset quantity
    }

    public function render()
    {
        return view('livewire.client.carts.add-to-cart');
    }
}

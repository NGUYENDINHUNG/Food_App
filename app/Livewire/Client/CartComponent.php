<?php

namespace App\Livewire\Client;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Food;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;


#[Layout('layouts.client')]
class CartComponent extends Component
{
    public $cart;
    public $quantities = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $user = Auth::user();

        if (!$user) {
            $this->cart = null;
            return;
        }

        $this->cart = Cart::with(['cartDetails.food'])->where('user_id', $user->id)->first();

        if ($this->cart) {
            foreach ($this->cart->cartDetails as $item) {
                $this->quantities[$item->id] = $item->quantity;
            }
        }
    }
    public function updateQuantity($cartDetailId, $quantity)
    {
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cartDetail = CartDetail::with('food')->findOrFail($cartDetailId);

        // Kiểm tra tồn kho
        if ($cartDetail->food->quantity < $quantity) {
            session()->flash('error', 'Không đủ hàng trong kho. Chỉ còn ' . $cartDetail->food->quantity . ' sản phẩm.');
            return;
        }

        $cartDetail->update(['quantity' => $quantity]);
        $this->quantities[$cartDetailId] = $quantity;

        session()->flash('success', 'Đã cập nhật số lượng');
        $this->loadCart();
    }

    public function removeFromCart($cartDetailId)
    {
        CartDetail::findOrFail($cartDetailId)->delete();
        unset($this->quantities[$cartDetailId]);

        session()->flash('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        $this->loadCart();
    }

    public function clearCart()
    {
        if ($this->cart) {
            $this->cart->cartDetails()->delete();
            $this->quantities = [];
        }

        session()->flash('success', 'Đã xóa toàn bộ giỏ hàng');
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.client.carts.index');
    }
}

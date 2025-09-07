<?php

namespace App\Livewire\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.client')]
class OrderComponent extends Component
{
    public $cart;
    public $shippingAddress = '';
    public $paymentMethod = 'cod';
    public $note = '';
    public $totalAmount = 0;
    public $isProcessing = false;

    protected $rules = [
        'shippingAddress' => 'required|string|min:10',
        'paymentMethod' => 'required|in:cod,bank_transfer',
        'note' => 'nullable|string|max:500',
    ];
    protected $messages = [
        'shippingAddress.required' => 'Vui lòng nhập địa chỉ giao hàng',
        'shippingAddress.min' => 'Địa chỉ giao hàng phải có ít nhất 10 ký tự',
        'paymentMethod.required' => 'Vui lòng chọn phương thức thanh toán',
        'paymentMethod.in' => 'Phương thức thanh toán không hợp lệ',
        'note.max' => 'Ghi chú không được vượt quá 500 ký tự',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Vui lòng đăng nhập để đặt hàng');
            return redirect()->route('auth.login');
        }

        $this->loadCart();
        $this->shippingAddress = Auth::user()->address ?? '';
    }

    public function loadCart()
    {
        $user = Auth::user();

        $cart = Cart::with(['cartDetails.food'])
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            $this->redirectRoute('cart.index');
            return;
        }

        $this->cart = $cart;
        $this->totalAmount = $cart->cartDetails->sum(fn($item) => $item->quantity * $item->unit_price);
    }
    public function placeOrder()
    {
        $this->validate();

        if ($this->isProcessing) {
            return;
        }

        $this->isProcessing = true;

        try {
            DB::beginTransaction();

            $this->loadCart();
            if (!$this->cart || $this->cart->cartDetails->count() == 0) {
                throw new \Exception('Giỏ hàng trống');
            }

            foreach ($this->cart->cartDetails as $cartDetail) {
                if ($cartDetail->food->quantity < $cartDetail->quantity) {
                    throw new \Exception("Không đủ hàng trong kho cho sản phẩm: {$cartDetail->food->name}.
                     Chỉ còn {$cartDetail->food->quantity} sản phẩm.");
                }
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $this->totalAmount,
                'status' => 'pending',
                'payment_method' => $this->paymentMethod,
                'payment_status' => 'pending',
                'shipping_address' => $this->shippingAddress,
                'note' => $this->note,
            ]);

            foreach ($this->cart->cartDetails as $cartDetail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'food_id' => $cartDetail->food_id,
                    'quantity' => $cartDetail->quantity,
                    'unit_price' => $cartDetail->unit_price,
                    'total_price' => $cartDetail->quantity * $cartDetail->unit_price,
                    'note' => null,
                ]);

                // Cập nhật tồn kho
                $cartDetail->food->decrement('quantity', $cartDetail->quantity);
            }

            // Xóa giỏ hàng
            $this->cart->cartDetails()->delete();

            DB::commit();

            return redirect()->route('order.success', ['orderId' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('client.orders.index');
    }
}

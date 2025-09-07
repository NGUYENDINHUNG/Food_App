<?php

namespace App\Livewire\Client;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.client')]
class OrderSuccessComponent extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId = null)
    {
        if (!$orderId) {
            // Nếu không có orderId, lấy đơn hàng mới nhất của user
            $this->order = Order::with(['orderDetails.food'])
                ->where('user_id', Auth::id())
                ->latest()
                ->first();
        } else {
            $this->order = Order::with(['orderDetails.food'])
                ->where('id', $orderId)
                ->where('user_id', Auth::id())
                ->first();
        }

        if (!$this->order) {
            session()->flash('error', 'Không tìm thấy đơn hàng');
            return redirect()->route('home');
        }

        $this->orderId = $this->order->id;
    }

    public function render()
    {
        return view('client.orderSuccess.index', [
            'order' => $this->order
        ]);
    }
}

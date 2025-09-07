<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class OrderManagement extends Component
{
    use WithPagination;
    public $showDetailModal = false;
    public $selectedOrder = null;

    public function confirmOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'status' => 'confirmed'
        ]);

        session()->flash('success', "Đã xác nhận đơn hàng #{$orderId}");
    }

    public function cancelOrder($orderId)
    {
        $order = Order::with('orderDetails.food')->findOrFail($orderId);

        // Hoàn trả tồn kho
        foreach ($order->orderDetails as $detail) {
            $detail->food->increment('quantity', $detail->quantity);
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        session()->flash('success', "Đã hủy đơn hàng #{$orderId}");
    }

    public function getStatusText($status)
    {
        return match ($status) {
            'pending' => 'Chờ xử lý',
            'confirmed' => 'Đang xử lý',
            'cancel' => 'Đã hủy',
            default => $status
        };
    }

    public function getStatusColor($status)
    {
        return match ($status) {
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        session()->flash('success', 'Xóa thành công!');
    }
    public function render()
    {
        $orders = Order::with(['user', 'orderDetails'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }
}

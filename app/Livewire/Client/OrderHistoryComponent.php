<?php

namespace App\Livewire\Client;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.client')]
class OrderHistoryComponent extends Component
{
    use WithPagination;

    public $statusFilter = '';
    public $searchTerm = '';

    protected $queryString = [
        'statusFilter' => ['except' => ''],
        'searchTerm' => ['except' => ''],
    ];

    public function filterByStatus($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function clearFilter()
    {
        $this->statusFilter = '';
        $this->searchTerm = '';
        $this->resetPage();
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($order) {
            $order->update(['status' => 'cancelled']);
            session()->flash('success', 'Đã hủy đơn hàng #' . $orderId);
        } else {
            session()->flash('error', 'Không thể hủy đơn hàng này');
        }
    }

    public function render()
    {
        $orders = Order::with(['orderDetails.food'])
            ->where('user_id', Auth::id())
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('id', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.ordersHistory.index', [
            'orders' => $orders
        ]);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Dashboard extends Component
{

    public function getStatusText($status)
    {
        return match ($status) {
            'pending' => 'Chờ xử lý',
            'confirmed' => 'Đang xử lý',
            'cancelled' => 'Đã hủy',
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

    public function render()
    {
        // Thống kê cơ bản theo yêu cầu
        $totalCategories = Category::count();
        $totalFoods = Food::count();
        $totalOrders = Order::count();

        // Đơn hàng gần đây (5 đơn hàng mới nhất)
        $recentOrders = Order::with(['user', 'orderDetails'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', [
            'totalCategories' => $totalCategories,
            'totalFoods' => $totalFoods,
            'totalOrders' => $totalOrders,
            'recentOrders' => $recentOrders
        ]);
    }
}

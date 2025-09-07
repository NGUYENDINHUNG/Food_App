<?php

namespace App\Livewire\Admin;

use App\Models\Food;
use App\Models\OrderDetail;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class FoodManagement extends Component
{
    use WithFileUploads;
    public $name, $description, $image, $price, $category_id, $editId, $quantity, $currentImage;
    public $showModal = false;
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => [$this->editId ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'quantity' => ['required', 'integer', 'min:0'],
        ];
    }
    public function save()
    {
        $this->validate();


        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
        ];

        if ($this->image) {
            $path = $this->image->store('foods', 'public');
            $data['image'] = '/storage/' . $path;
        } elseif ($this->editId) {
            $data['image'] = $this->currentImage;
        }

        if ($this->editId) {
            Food::findOrFail($this->editId)->update($data);
        } else {
            Food::create($data);
        }

        session()->flash('success', $this->editId ? 'Cập nhật thành công!' : 'Tạo mới thành công!');

        $this->reset(['name', 'description', 'image', 'editId', 'showModal', 'quantity']);
    }

    public function delete($id)
    {
        try {
            $food = Food::findOrFail($id);

            $orderDetailsCount = OrderDetail::where('food_id', $id)->count();

            if ($orderDetailsCount > 0) {
                session()->flash('error', 'Không thể xóa món ăn này vì đã có đơn hàng sử dụng. Vui lòng xóa các đơn hàng liên quan trước.');
                return;
            }

            if ($food->image) {
                $filePath = str_replace('/storage/', '', $food->image);
                Storage::disk('public')->delete($filePath);
            }

            $food->delete();
            session()->flash('success', 'Xóa thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi xóa món ăn: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $this->reset(['name', 'description', 'image', 'editId', 'quantity']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $this->editId = $id;
        $this->name = $food->name;
        $this->description = $food->description;
        $this->price = $food->price;
        $this->category_id = $food->category_id;
        $this->quantity = $food->quantity;
        $this->currentImage = $food->image;
        $this->image = null;
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'image', 'editId', 'showModal', 'quantity', 'currentImage']);
    }
    public function render()
    {
        $foods = Food::latest()->get();
        return view('admin.foods.index', compact('foods'));
    }
}

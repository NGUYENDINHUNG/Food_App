<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class CategoryManagement extends Component
{
    use WithFileUploads;

    public $name, $description, $image, $editingId, $currentImage;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($this->editingId)],
            'description' => ['required', 'string', 'max:255'],
            'image' => [$this->editingId ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ];

        $disk = config('filesystems.default');
        if ($this->image) {
            $path = $this->image->storePublicly('categories', $disk);
            $data['image'] = $path; 
        } elseif ($this->editingId) {
            $data['image'] = $this->currentImage; 
        }

        if ($this->editingId) {
            Category::findOrFail($this->editingId)->update($data);
        } else {
            Category::create($data);
        }

        session()->flash('success', $this->editingId ? 'Cập nhật thành công!' : 'Tạo mới thành công!');
        $this->reset(['name', 'description', 'image', 'editingId', 'showModal']);
    }


    public function delete($id)
    {
        $c = Category::findOrFail($id);
        $disk = config('filesystems.default');

        $foods = Food::where('category_id', $id)->get();
        foreach ($foods as $food) {
            if ($food->image) {
                Storage::disk($disk)->delete($food->image);
            }
            $food->delete();
        }

        if ($c->image) {
            Storage::disk($disk)->delete($c->image);
        }
        $c->delete();

        session()->flash('success', 'Xóa thành công!');
    }

    public function create()
    {
        $this->reset(['name', 'description', 'image', 'editingId']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->editingId = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->currentImage = $category->image; 
        $this->image = null;
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'image', 'editingId', 'showModal', 'currentImage']);
    }

    public function render()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }
}

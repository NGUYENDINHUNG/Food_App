 <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">
                     {{ $editId ? 'Chỉnh sửa món ăn' : 'Thêm món ăn mới' }}
                 </h5>
                 <button type="button" class="btn-close" wire:click="resetForm"></button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent="save">
                     <div class="row g-3">
                         <div class="col-md-6">
                             <label class="form-label">Tên món ăn <span class="text-danger">*</span></label>
                             <input type="text" class="form-control @error('name') is-invalid @enderror"
                                 wire:model.defer="name" placeholder="Nhập tên món ăn">
                             @error('name')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="col-md-6">
                             <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                             <select class="form-select @error('category_id') is-invalid @enderror"
                                 wire:model.defer="category_id">
                                 <option value="">Chọn danh mục</option>
                                 @foreach (\App\Models\Category::all() as $category)
                                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                                 @endforeach
                             </select>
                             @error('category_id')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="col-md-6">
                             <label class="form-label">Giá <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <input type="number" class="form-control @error('price') is-invalid @enderror"
                                     wire:model.defer="price" placeholder="0" min="0" step="1000">
                                 <span class="input-group-text">đ</span>
                             </div>
                             @error('price')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="col-md-6">
                             <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                             <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                 wire:model.defer="quantity" placeholder="0" min="0">
                             @error('quantity')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="col-md-6">
                             <label class="form-label">Ảnh món ăn
                                 @if (!$editId)
                                     <span class="text-danger">*</span>
                                 @else
                                     <small class="text-muted">(Để trống nếu không muốn thay đổi)</small>
                                 @endif
                             </label>
                             <input type="file" class="form-control @error('image') is-invalid @enderror"
                                 wire:model="image" accept="image/*">
                             @error('image')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror

                             {{-- Hiện ảnh cũ khi đang edit và chưa chọn ảnh mới --}}
                             @if ($currentImage && !$image)
                                 <div class="mt-2">
                                     <p class="text-muted small mb-1">Ảnh hiện tại:</p>
                                     <img src="{{ $currentImage }}" alt="Ảnh hiện tại" class="img-thumbnail"
                                         style="max-width: 150px;">
                                 </div>
                             @endif

                             {{-- Preview ảnh mới khi người dùng chọn file --}}
                             @if ($image)
                                 <div class="mt-2">
                                     <p class="text-muted small mb-1">Ảnh mới:</p>
                                     <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-thumbnail"
                                         style="max-width: 150px;">
                                 </div>
                             @endif
                         </div>


                         <div class="col-12">
                             <label class="form-label">Mô tả <span class="text-danger">*</span></label>
                             <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" rows="3"
                                 placeholder="Nhập mô tả món ăn"></textarea>
                             @error('description')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" wire:click="resetForm">Hủy</button>
                 <button type="button" class="btn btn-primary" wire:click="save">
                     <i class="fas fa-save"></i> {{ $editId ? 'Cập nhật' : 'Lưu' }}
                 </button>
             </div>
         </div>
     </div>
 </div>

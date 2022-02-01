<a data-bs-toggle="modal" data-bs-target="#editProduct-{{ $product->tag_number }}" class="btn btn-sm btn-primary"> <i class="bi bi-pencil-square"></i> </a>
<a href="{{ route('admin.product.delete', $product->id) }}"
    onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"> <i class="bi bi-trash-fill"></i> </a>


<div class="modal fade" id="editProduct-{{ $product->tag_number }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->name }}"
                            required aria-describedby="helpId">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required
                            aria-describedby="helpId">
                    </div>
                    @if (request()->is('admin/products'))
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select class="form-control" name="category">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
</div>







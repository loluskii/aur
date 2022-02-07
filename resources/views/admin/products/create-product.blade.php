<div class="modal fade" id="createProduct" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                <div class="modal-body px-4">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image" id="" placeholder=""
                            aria-describedby="fileHelpId">
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Product Name"
                                    aria-describedby="helpId" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">---</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" id=""
                            rows="2"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Unit Price</label>
                        <input type="text" name="unit_price" class="form-control" placeholder="Amount"
                            aria-describedby="helpId" value="">
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Number of Units</label>
                                <input type="text" name="units" class="form-control" placeholder="Quantity"
                                    aria-describedby="helpId" value="">
                            </div>        
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Alert Quantity</label>
                                <input type="text" name="alert_quantity" class="form-control" placeholder="Alert Quantity"
                                    aria-describedby="helpId" value="">
                            </div>        
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Feature on Homepage</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

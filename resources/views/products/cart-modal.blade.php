<div class="modal modal-right fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title">SHOPPING BAG</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $cartItems = \Cart::session(auth()->id())->getContent();
                @endphp
                @foreach ($cartItems as $item)
                <div class="d-flex justify-content-between border-bottom  py-3">
                    <div class="d-flex w-100">
                        <img src="{{ asset('images/'.$item->associatedModel->image) }}" class="img-fluid" style="height: 60px;" alt="" srcset="">
                        <div class="ms-4 d-flex flex-column">
                            <p>{{ $item->name }}</p>
                            <div class="d-flex mt-auto">
                                <form action="{{route('cart.update', $item->id)}}" method="POST">
                                    @csrf
                                    <input type="number" onchange="this.form.submit()" class="qty-text me-5" id="qty2" step="1" min="1" max="99" name="quantity" style="width: 50px; text-align: center; border-radius: 3px; border: 1px solid rgb(228, 228, 228)" value="{{ $item->quantity }}">
                                </form>
                                {{-- <i class="fa fa-trash"></i> --}}
                                <p class="me-5">${{ number_format($item->price,2) }}</p>
                                <a href="{{ route('cart.destroy', $item->id) }}">
                                        <small> DELETE</small>
                                </a>

                            </div>
                        </div>
                    </div>
                    {{-- <td>${{ $item->price }}</td> --}}

                </div>
                @endforeach



            </div>
            <div class="d-flex justify-content-between modal-footer">
                <h4 class="font-weight-bold">${{ number_format(Cart::session(auth()->id())->getTotal(),2 )}}</h4>
                <a href="{{ route('checkout.index') }}" class="btn btn-dark btn-block btn-lg">CHECKOUT</a>
            </div>
        </div>
    </div>
</div>

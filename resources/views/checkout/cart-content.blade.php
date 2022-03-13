<div class="col-md-5 col-lg-5 d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
    <div class="product border-bottom">
        <table class="table table-borderless">
            <tbody>
                @foreach ($cartItems as $item)
                <tr class="d-flex align-items-center">
                    <td scope="row" style="width: 20%;">
                        <img class="img-fluid img-thumbnail" style="height: 60px;"
                            src="{{ $item->associatedModel->images()->first()->image_url ?? '' }}" alt="">
                    </td>
                    <td style="width: 60%;">
                        <span
                            class="product__description__variant order-summary__small-text text-uppercase"
                            style="display: block;">{{ $item->name }}</span>
                    </td>
                    <td style="width: 20%; display: flex; justify-content: end;">
                        ${{ number_format($item->price,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="price border-bottom">
        <div class="d-flex justify-content-between align-items-center py-3">
            <span>Subtotal</span>
            <span>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(),2) }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center py-3">
            <span>Shipping</span>
            <span class="text-muted small">Calculated at the next step</span>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center py-4">
        <span>Order Total</span>
        <div class="d-flex align-items-center">
            <small style="font-size: 13px" class="text-muted">USD</small> <h3>{{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(),2) }}
        </div>
        </h3>
    </div>
</div>

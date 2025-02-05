<div class="modal modal-left fade" id="mobileSideNav" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog w-75" role="document">
        <div class="modal-content p-4" style="background-color: black; color: white">
            <div class="modal-header">
                {{-- <h5 class="modal-title">SHOPPING BAG</h5> --}}
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12">
                        <ul class="ps-0">

                            <li class="nav-item">
                                <a class="nav-link py-3 text-white"
                                    style="font-weight: 800; font-size: 17px; text-transform: uppercase; text-decoration: none"
                                    href="{{ route('shop') }}">SHOP</a>
                            </li>
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link py-3 text-white"
                                        style="font-weight: 800; font-size: 17px; text-transform: uppercase; text-decoration: none"
                                        href="{{ route('product.category', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link py-3 text-white"
                                        style="font-weight: 800; font-size: 17px; text-transform: uppercase; text-decoration: none"
                                        href="{{ route('account') }}">ACCOUNT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3 text-white"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        style="font-weight: 800; font-size: 1.5rem; text-transform: uppercase; text-decoration: none"
                                        href="">LOG OUT</a>
                                </li>
                                <form id="logout-form" action="{{ route('signout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link py-3 text-white"
                                        style="font-weight: 800; font-size: 15px; text-transform: uppercase; text-decoration: none"
                                        href="{{ route('login') }}">LOG IN</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link py-3 text-white"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none"
                                    href="{{ route('account') }}">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 text-white"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none"
                                    href="{{ route('account') }}">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 text-white"
                                    style="font-weight: 800; font-size: 15px; text-decoration: none"
                                    href="{{ route('account') }}">Contact</a>
                            </li>

                        </ul>
                    </div>
                </div>



            </div>
            {{-- <div class="d-flex justify-content-between modal-footer">
                <h4 class="font-weight-bold">${{ number_format(Cart::auth()->check() ? auth()->id() : 'guest'->getTotal(),2 )}}</h4>
                <a href="{{ route('checkout.index') }}" class="btn btn-dark btn-block btn-lg {{ $cartItems->count() > 0 ? '':'disabled' }}">CHECKOUT</a>
            </div> --}}
        </div>
    </div>
</div>

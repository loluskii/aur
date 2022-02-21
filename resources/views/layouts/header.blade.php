<style>
.header-img{
    min-width: 210px;
}
/* @media screen and (max-width : 569px){
    .header-img{
        min-width: 110px;
    }

} */
</style>
@guest
<div class="header mb-5">
    <nav class="navbar navbar-expand-lg navbar-light bg- py-4">
        <div class="container-fluid px-md-5 px-lg-5 px-0">
            <div class="collapse navbar-collapse" id="">
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('shop') }}">SHOP <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SUBSCRIBE TO NEWSLETTER</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">T-SHIRTS</a>
                    </li> --}}
                </ul>
            </div>
            <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="modal" data-bs-target="#mobileSideNav" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="header-img text-center text-md-center text-lg-start">
                <a class="navbar-brand mx-auto" href="/"><img src="{{ asset('images/2611.png') }}" style="height: 30px" class="img-fluid" alt="" srcset=""></a>
            </div>
            <a class="nav-link d-lg-none text-decoration-none text-dark" href="">CART</a>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link me-3" href="{{ route('login') }}">LOGIN <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CART</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav justify-content-center py-2 d-none d-md-flex d-lg-flex">
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">T-SHIRTS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">SWEATSHIRTS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">OUTWEAR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">BOTTOMS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">ACCESSORIES</a>
        </li>
    </ul>

</div>

@include('layouts.partials.mobile-nav')

@endguest

@auth

<header class="mb-5">
    <nav class="navbar navbar-expand-lg navbar-light bg- py-4">
        <div class="container-fluid px-lg-5 px-md-5 px-sm-0 px-xs-0">
            <div class="collapse navbar-collapse" id="">
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('shop') }}">SHOP <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SWEATSHIRTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">T-SHIRTS</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler d-lg-none border-0" data-bs-toggle="modal" data-bs-target="#mobileSideNav" type="button" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="header-img text-center text-md-center text-lg-center">
                <a class="navbar-brand mx-auto" href="/"><img src="{{ asset('images/2611.png') }}" style="height: 30px" class="img-fluid" alt="" srcset=""></a>
            </div>
            <a class="navbar-brand d-lg-none" style="font-size: inherit" data-bs-toggle="modal" data-bs-target="#modelId" href="#">CART ({{ Cart::session(auth()->id())->getContent()->count()}})</a>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link me-3" href="{{ route('account') }}">MY ACCOUNT<span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modelId" href="">CART ({{ Cart::session(auth()->id())->getContent()->count()}})</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav justify-content-center py-2 d-none d-md-flex d-lg-flex">
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">T-SHIRTS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">SWEATSHIRTS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">OUTWEAR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">BOTTOMS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-decoration-none text-muted" href="#">ACCESSORIES</a>
        </li>
    </ul>
</header>

</div>

<!-- Button trigger modal -->

<!-- Modal -->
@include('products.cart-modal')
@include('layouts.partials.mobile-nav')
@endauth
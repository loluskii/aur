@extends('layouts.app')

@section('styles')
<style>
    * {
        text-transform: none;
    }

    .main {
        padding-top: 40px;
        padding-right: 40px;
        padding-bottom: 30px;
        padding-left: 20px;

    }

    .wrapper {
        /* padding-left: 30px;
        padding-right: 30px;
        margin-left: 30px;
        margin-right: 30px; */
    }

    .form-control::placeholder {
        color: #837C7C;
        opacity: 1;
        font-size: 15px;
        font-weight: 500px;
    }

    .product__description__variant {
        font-size: 13px;
    }
    
    button, button span {
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 5px 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }


    button:hover {
        filter: contrast(115%);
    }

    button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }
    .hidden{
        display: none;
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #212529;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #212529;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 595px) {
        .main {
            padding: 20px;
        }

        .wrapper {
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }
    }
</style>

@endsection

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row mb-5" style="min-height: 90vh">
                <div class="col-md-7 col-lg-7">
                    <div class="main">
                        <div class="header">
                            <img src="{{ asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt="">
                            <nav aria-label="breadcrumb" class="py-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                                    <li class="breadcrumb-item"><a href="#">Information</a></li>
                                    <li class="breadcrumb-item">Shipping</li>
                                    <li class="breadcrumb-item ">Payment</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="d-flex justify-content-between">
                                {{-- <h4 class="mb-4">Contact Information</h4> --}}
                            </div>
                            <form action="{{ route('payment.create') }}" method="post" class="pb-5"
                                id="payment-form">
                                @csrf
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="contact d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Contact</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-uppercase text-wrap">{{ Auth::user()->email
                                                        }}</span>
                                                </div>
                                            </div>
                                            <a href=""><small class="text-danger fw-bold">Change</small></a>
                                        </div>
                                        <hr style="width: auto">
                                        <div class="shipping d-flex justify-content-between align-items-center">
                                            <div class="">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Ships to</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">{{ $order->shipping_address }},{{
                                                        $order->shipping_zipcode }} {{ $order->shipping_state }}, {{
                                                        $order->shipping_zipcode }}</span>
                                                </div>
                                            </div>
                                            <a href=""><small class="text-danger fw-bold">Change</small></a>
                                        </div>
                                        <hr style="width: auto">
                                        <div class="method d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Method</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">Standard Shipping . $50 </span>
                                                </div>
                                            </div>
                                            {{-- <a href=""><small class="text-danger fw-bold">Change</small></a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-information">
                                    <h4 class="fw-bold">Payment</h4>
                                    <p>All payments are secure and encrypted. We will never share your details with
                                        anyone</p>


                                </div>
                                <div class="col-12 pt-3">
                                    <div class="accordion bg-white" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header bg-light" id="headingOne">
                                                <div class="checkbox py-3 px-3">
                                                    <label data-bs-toggle="collapse" class="w-100"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>Credit Card</h4>
                                                            <div class="d-flex align-items-center images">
                                                                <img src="{{ asset('images/payment/visa.svg') }}"
                                                                    class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/master.svg') }}"
                                                                    class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/american_express.svg') }}"
                                                                    class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/discover.svg') }}"
                                                                    class="img-fluid" alt="" srcset="">
                                                                {{-- <span>and more ...</span> --}}
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse show "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div id="card-errors" class="element-errors alert alert-danger" role="alert"> </div>
                                                    {{-- <div id="card-errors" class="element-errors">sdsdf</div> --}}
                                                    
                                                    <div class="form-group mb-3">
                                                        <input type="text" class="form-control form-control-lg"
                                                            placeholder="Cardholder Name" id="card_holder_name">

                                                    </div>
                                                    <div id="card-element" class="form-control form-control-lg"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button id="card-button" class="mt-4 payment-button btn btn-dark btn-lg px-3"
                                    type="submit" data-secret="{{ $intent->client_secret }}"> <div class="spinner hidden my-2" id="spinner"></div>
                                    <span id="button-text">Pay now</span>
                                </button>
                                <div class="col-12 text-center mt-3">
                                    <a href="{{ route('checkout.step_two.index') }}" class="">Back to Shipping</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 d-sm-none d-md-block border-start ps-4 pt-5">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr class="d-flex align-items-center">
                                    <td scope="row" style="width: 20%;">
                                        <img class="img-fluid img-thumbnail" style="height: 60px;"
                                            src="{{ asset('images/'.$item->associatedModel->image) }}" alt="">
                                    </td>
                                    <td style="width: 60%;">
                                        <span
                                            class="product__description__variant order-summary__small-text text-uppercase"
                                            style="display: block;">{{ $item->name }}</span>
                                    </td>
                                    <td style="width: 20%;">
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
                            <span>${{ number_format(Cart::session(auth()->id())->getSubTotal(),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span>Shipping</span>
                            <span>${{ $condition_value }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <span>Shipping</span>
                        <h2>${{ number_format(Cart::session(auth()->id())->getTotal(),2) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            padding: '30px',
            fontFamily: '"Century Gothic",Arial,sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: 'en' }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card',{
        style:style
    }); // Create an instance of the card Element.
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    const cardHolderName = document.getElementById('card_holder_name');
    // var displayError = document.getElementById('card-errors');
    document.querySelector("#card-errors").classList.add("hidden");

    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            document.querySelector("#card-errors").classList.remove("hidden");
            displayError.textContent = event.error.message;
            setLoading(false);
        } else {
            document.querySelector("#card-errors").classList.add("hidden");
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        setLoading(true);
        stripe.handleCardSetup(clientSecret, cardElement, {
                payment_method_data: {
                    billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    document.querySelector("#card-errors").classList.remove("hidden");
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    setLoading(false);
                } else {
                    console.log(result);
                    // Send the token to your server.
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(paymentMethod) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'paymentMethod');
        hiddenInput.setAttribute('value', paymentMethod);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
    
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#card-button").classList.add("disabled");
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#card-button").classList.remove("disabled");
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }
        
</script>
@endsection
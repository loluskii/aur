@extends('layouts.app')
@section('styles')
    <style>
        #about-us p, #about-us h6{
            font-size: 14px;
            line-height: 30px;
            text-transform: none;
        }
    </style>
@endsection
@section('content')
    <div class="container pt-3 pb-5" id="about-us" style="min-height: 70vh">
    
        <div class="row">
            
            <div class="col-md-10 mx-auto col-lg-10 col-sm-12">
                <section class="py-3">
                    <h6 class="text-start fw-bolder">Shipping</h6>
                    <p>All orders are shipped from Turkey and Nigeria . While orders are typically shipped within 2-3 business days, orders may take longer due to unforeseen circumstances. You will receive an order confirmation email once your order has been successfully placed and additional emails once your order has been shipped and delivered.</p>
                    <p>AUR 2611 is not liable for any misplaced or stolen packages. If the address provided to us upon checkout matches the exact address we have shipped your order to, and your tracking number reads as successfully shipped - we are not held responsible if your package has been misplaced. Stolen / lost packages are non-refundable. Certain misunderstandings may apply but evidence must be recorded, please contact orders@aur2611.com and we will try our best to assist you with this matter. </p>
                </section>
                <section class="py-3">
                    <h6 class="text-start fw-bolder">Pre-Orders</h6>
                    <p>Pre-order & made to order items will ship once stock becomes available. The estimated delivery date will be listed in the product description of the item. You will receive an email with tracking once it’s been shipped.</p>
                    <p>Pre-order shipping dates are subject to delays.</p>
                    <p class="fw-bold">Pre-Orders / Made To Order products are not eligible for cancellation or refunds.</p>
                </section>
                <section class="py-3">
                    <h6 class="text-start fw-bolder">International Orders</h6>
                    <p>All international orders are shipped Delivered Duties Unpaid (DDU). This means that you, the customer, are responsible for paying your local country's import duties at time of delivery. Placing an order to an international destination serves as confirmation that you understand your responsibility to pay these fees. Unfortunately, we are unable to calculate these fees at time of purchase.</p>
                </section>
                <section class="py-3">
                    <h6 class="text-start fw-bolder">Returns</h6>
                    <p>Orders can be returned for free within 15 days of the order being placed. All returned items must be in new unworn condition with tags still attached. Returned items received in any other condition will be sent back at your expense unless otherwise agreed upon. We are unable to accept returns after 15 days from time of order. You can contact orders@aur2611.com to initiate your return.</p>
                </section>
                <section class="py-3">
                    <h6 class="text-start fw-bolder">Exchanges</h6>
                    <b>**PLEASE NOTE:  Due to the current COVID-19 Global Pandemic, we will be unable to process exchanges for the time being.**</b>
                    <p>In certain situations, we may be able to exchange damaged or mislabeled items may be exchanged for the proper item or size for free within 15 days of the order being placed. Please note, we are unable to provide exchanges for international orders. For international exchanges, we ask that you initiate a return and place a replacement order.</p>
                </section>
                                
            </div>
        </div>
    </div>
@endsection
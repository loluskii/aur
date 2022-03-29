@extends('layouts.app')

@section('styles')
    <style>
        * {
            text-transform: none;
            font-size: 14px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif;
            line-height: 1.3em;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
            -webkit-font-smoothing: subpixel-antialiased;
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

        .accordion-button:not(.collapsed) {
            color: #000;
            background-color: #fff;
            box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
        }

        .accordion-body {
            padding: 1rem 1.25rem;
            background-color: #e6e6e6;
        }

    </style>
@endsection

@section('content')
    <div class="bg-light">
        <div class="container px-0">
            <div class="wrapper px-0">
                <div class="row mb-5">
                    <div class="col-md-7 col-lg-7 col-12">
                        <div class="main">
                            <div class="header">
                                <a href="/"><img src="{{ secure_asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt=""></a>
                                <nav aria-label="breadcrumb" class="py-4">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" aria-current="page"><a
                                                href="{{ route('shop') }}">Cart</a></li>
                                        <li class="breadcrumb-item active fw-bold"><a style="font-weight: 500"
                                                href="{{ route('checkout.index') }}">Information</a></li>
                                        <li class="breadcrumb-item">Shipping</li>
                                        <li class="breadcrumb-item ">Payment</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="body py-3">
                                <div class="mb-4 d-sm-block d-md-none d-lg-none">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed px-1 fw-bold border-bottom"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseOne" aria-expanded="true"
                                                    aria-controls="flush-collapseOne">
                                                    <i class="bi bi-cart4 me-2" style="font-size: 25px"></i> Show Order
                                                    Summary
                                                    ${{ number_format(\Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }}
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="product border-bottom">
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                @foreach ($cartItems as $item)
                                                                    <tr class="d-flex justify-content-between align-items-center">
                                                                        {{-- <td scope="row" style="width: 20%;">
                                                                            <img class="img-fluid img-thumbnail"
                                                                                style="height: 60px;"
                                                                                src="{{ $item->associatedModel->image }}"
                                                                                alt="">
                                                                        </td> --}}
                                                                        <td style="width: 60%;">
                                                                            <span
                                                                                class="product__description__variant order-summary__small-text text-uppercase"
                                                                                style="display: block;">{{ $item->name }}</span>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            ${{ number_format($item->price, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="price border-bottom">
                                                        <div class="d-flex justify-content-between align-items-center py-3">
                                                            <span>Subtotal</span>
                                                            <span>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(), 2) }}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center py-3">
                                                            <span>Shipping</span>
                                                            <span>Calculated at the next step</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center py-4">
                                                        <span>Order Total</span>
                                                        <h3>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }}
                                                        </h3>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-4" style="font-weight: normal">Contact Information</h4>
                                    @if (!Auth::check())
                                        <small>Have an account already? <a style="color: #bf7a49; font-weight: 500"
                                                href="{{ route('login') }}">Log in</a></small>
                                    @endif
                                </div>
                                <form action="{{ route('checkout.step_one') }}" method="post" class="pb-5">
                                    @csrf
                                    @if (Auth::check())
                                        <input type="hidden" name="shipping_email" value="{{ Auth::user()->email }}">
                                        <div class="card-body mb-3 ps-0">
                                            <h6>{{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                                ({{ Auth::user()->email }})
                                            </h6>
                                            <a href="{{ route('signout') }}"><small
                                                    class="text-danger">Logout</small></a>
                                        </div>
                                    @else
                                        <div class="mb-5">
                                            <input name="shipping_email" value="" type="email" style="padding: 12px 10px"
                                                class="form-control " placeholder="Email" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <div id="emailHelp" class="form-text">We'll never share your email with
                                                anyone
                                                else.</div>
                                        </div>
                                    @endif
                                    <div class="shipping-information">
                                        <h4 class="mb-4" style="font-weight: normal">Shipping Address</h4>
                                        <div class="mb-3">
                                            <!-- <small class="text-muted">Country/Region</small> -->
                                            <select class="form-select" style="padding: 12px 10px" name="shipping_country" required aria-label="Default select example">
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Åland Islands</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia, Plurinational State of</option>
                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo</option>
                                                <option value="CD">Congo, the Democratic Republic of the</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Côte d'Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Curaçao</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="VA">Holy See (Vatican City State)</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran, Islamic Republic of</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                <option value="KR">Korea, Republic of</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Lao People's Democratic Republic</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao</option>
                                                <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia, Federated States of</option>
                                                <option value="MD">Moldova, Republic of</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Réunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin (French part)</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SX">Sint Maarten (Dutch part)</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syrian Arab Republic</option>
                                                <option value="TW">Taiwan, Province of China</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania, United Republic of</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UM">United States Minor Outlying Islands</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                <option value="VN">Viet Nam</option>
                                                <option value="VG">Virgin Islands, British</option>
                                                <option value="VI">Virgin Islands, U.S.</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>

                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col">
                                                <!-- <small class="text-muted">First Name</small> -->
                                                <input type="text" style="padding: 12px 10px" name="shipping_fname"
                                                    class="form-control " required placeholder="First name"
                                                    value="{{ auth()->check() ? auth()->user()->fname : '' }}" aria-label="First name">
                                            </div>
                                            <div class="col">
                                                <!-- <small class="text-muted">Last Name</small> -->
                                                <input type="text" style="padding: 12px 10px" name="shipping_lname"
                                                    class="form-control " required placeholder="Last name"
                                                    value="{{ auth()->check() ? auth()->user()->lname : '' }}" aria-label="Last name">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="exampleInputEmail1" class="form-label">Address</label> -->
                                            <input type="address" style="padding: 12px 10px" name="shipping_address"
                                                placeholder="Address" required class="form-control "
                                                value="{{ $order_details->shipping_address ?? '' }}"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="exampleInputEmail1" class="form-label">Apartment, suite, etc. (optional)</label> -->
                                            <input type="text" style="padding: 12px 10px" name="shipping_landmark"
                                                placeholder="Apartment, suite, etc. (optional)" class="form-control "
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col">
                                                <!-- <small class="text-muted">City</small> -->
                                                <input type="text" style="padding: 12px 10px" name="shipping_city"
                                                    class="form-control "
                                                    value="{{ $order_details->shipping_city ?? '' }}" required
                                                    placeholder="City">
                                            </div>
                                            <div class="col">
                                                <!-- <small class="text-muted">City</small> -->
                                                <input type="text" style="padding: 12px 10px" name="shipping_state"
                                                    class="form-control "
                                                    value="{{ $order_details->shipping_state ?? '' }}" required
                                                    placeholder="State">
                                            </div>
                                            <div class="col">
                                                <!-- <small class="text-muted">Postal Code</small> -->
                                                <input type="text" style="padding: 12px 10px" name="shipping_zipcode"
                                                    value="{{ $order_details->shipping_zipcode ?? '' }}"
                                                    class="form-control " required placeholder="Postal Code"
                                                    aria-label="Postal Code">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="exampleInputEmail1" class="form-label">Contact Information</label> -->
                                            <input type="text" style="padding: 12px 10px" name="shipping_phone"
                                                value="{{ $order_details->shipping_phone ?? '' }}"
                                                placeholder="Phone Number" required class="form-control "
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center pt-3">
                                        <button type="submit" class="btn btn-primary btn-dark"
                                            style="padding: 1.4em 1.7em;">Continue to
                                            shipping</button>
                                        <a href="{{ route('cart.show') }}" class="ms-4">Return to Cart</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    @include('checkout.cart-content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var form = document.getElementById('shipping-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            setLoading(true);
            setTimeout(function() {
                $(".shipping-form").submit();
            }, 5000);
        });

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

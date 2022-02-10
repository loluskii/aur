
@extends('layouts.app')
@section('styles')
    <style>
        #about-us p, #about-us h6{
            font-size: 14px;
            line-height: 30px;
            text-transform: none;
        }
        .form-control{
            text-transform: none;
        }
    </style>
@endsection
@section('content')
    <div class="container pt-3 pb-5 px-3" id="about-us" style="min-height: 75vh">
    
        <div class="row">
            
            <div class="col-md-4 col-lg-4 col-sm-12 border-end">
                <a href="{{ route('account') }}" class="btn px-0 mb-1"> <i class="bi bi-arrow-left"></i> Back</a>
                <section class="py-3">
                    <h6 class="text-start fw-bolder">EDIT ADRRESS</h6>
                    
                </section>
                {{-- <a href="{{ route('account') }}" name="" id="" class="px-3 py-2 btn btn-dark fw-bold">GO BACK</a> --}}
                
                
            </div>
            <div class="col-md-8 col-lg-8 col-sm-12">
                <section class="py-3 px-0 px-md-3 px-lg-3 px-xl-4">
                    <div class="">
                        <form action="{{ route('account.address.store') }}" style="" method="post" class="pb-5">
                            @csrf
                            <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                            <div class="shipping-information">
                                <h6 class="mb-4 fw-bold">ADD A NEW ADDRESS</h6>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <!-- <small class="text-muted">First Name</small> -->
                                        <input type="text" name="shipping_fname" 
                                            class="form-control" value="{{ $address->shipping_fname ?? '' }}" required placeholder="First name"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <!-- <small class="text-muted">Last Name</small> -->
                                        <input type="text" name="shipping_lname"
                                            class="form-control" value="{{ $address->shipping_lname ?? '' }}" required placeholder="Last name"
                                            aria-label="Last name">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <!-- <label for="exampleInputEmail1" class="form-label">Address</label> -->
                                    <input type="address" name="shipping_address" value="{{ $address->shipping_address ?? '' }}" placeholder="Address Line 1" required
                                        class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <!-- <label for="exampleInputEmail1" class="form-label">Apartment, suite, etc. (optional)</label> -->
                                    <input type="text" name="shipping_landmark"  value="{{ $address->shipping_landmark ?? '' }}"
                                        placeholder="Apartment, suite, etc. (optional)"
                                        class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <!-- <label for="exampleInputEmail1" class="form-label">Apartment, suite, etc. (optional)</label> -->
                                    <input type="text" name="shipping_phone"  value="{{ $address->shipping_phone ?? '' }}"
                                        placeholder="Phone Number"
                                        class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="row mb-3 g-2">
                                    
                                    <div class="col">
                                        <!-- <small class="text-muted">City</small> -->
                                        <input type="text" name="shipping_state" value="{{ $address->shipping_state ?? '' }}"
                                            class="form-control" required
                                            placeholder="State">
                                    </div>
                                    <div class="col">
                                        <!-- <small class="text-muted">Country/Region</small> -->
                                        <select class="form-select" name="shipping_country" value="" required
                                            aria-label="Default select example">
                                            <option value="{{ $address->shipping_country ?? 'Nigeria' }}">{{ $address->shipping_country ?? 'Nigeria' }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <!-- <small class="text-muted">City</small> -->
                                        <input type="text" name="shipping_city" value="{{ $address->shipping_city ?? '' }}" class="form-control"  required
                                            placeholder="City">
                                    </div>
                                    <div class="col">
                                        <!-- <small class="text-muted">Postal Code</small> -->
                                        <input type="text" name="shipping_zipcode" value="{{ $address->shipping_zipcode ?? '' }}" 
                                            class="form-control" required placeholder="Postal Code"
                                            aria-label="Postal Code">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-12 pt-3">
                                <button type="submit" class="px-3 py-2 btn btn-primary btn-block btn-dark text-uppercase fw-bold">Save Address</button>
                            </div>
                        </form>

                    </div>
                </section>
                
                
            </div>
        </div>
    </div>
@endsection
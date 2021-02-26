@extends('layouts.main')

@section('content')
    <div id="confirmCheckOutPage">
        <!-- breadcrumb start -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h2>cart</h2>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="breadcrumb" class="theme-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb End -->


        <!--section start-->
        <section class="cart-section section-b-space" v-if="cartItem">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">action</th>
                                <th scope="col">total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in cartItems" :key="index">
                                <td>
                                    <a href="#"><img src="#" alt=""></a>
                                </td>
                                <td><a href="#">@{{ item.product.title }}</a>
                                    <div class="mobile-cart-content row">
                                        <div class="col-xs-3">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="text" v-model="item.quantity"  class="form-control input-number"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <h2 class="td-color">@{{ item.quantity }}</h2>
                                        </div>
                                        <div class="col-xs-3">
                                            <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h2>@{{ item.price  }}</h2>
                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" v-model="item.quantity" @change="updateQuantity(item.id, item.quantity, '{{ route('api.cart.update') }}')" class="form-control input-number"
                                            >
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" class="icon" @click="removeCartItem(item.id, '{{ route('api.cart.remove') }}')"><i class="ti-close"></i></a></td>
                                <td>
                                    <h2 class="td-color">@{{ item.quantity * item.price  }}</h2>
                                </td>
                            </tr>
                            </tbody>


                        </table>
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                            <tr>
                                <td>total price :</td>
                                <td>
                                    <h2>@{{ totalPrice }}</h2>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div>
                    <h5>Shipping Details</h5>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" class="form-control" v-model="shippingDetails.streetAddress">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" class="form-control" v-model="shippingDetails.city">
                        </div>
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" id="post_code" class="form-control" v-model="shippingDetails.postCode">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" class="form-control" v-model="shippingDetails.country">
                        </div>
                    </div>
                </div>

                <div class="row cart-buttons">
                    <div class="col-6"><a href="{{ route('flower.home') }}" class="btn btn-solid">continue shopping</a></div>
                    <div class="col-6"><button class="btn btn-solid" @click="checkoutComplete(orderId, '{{ route('api.cart.checkout') }}')">check out</button></div>
                </div>
            </div>
        </section>
        <!--section end-->

        <section class="cart-section section-b-space" v-if="!cartItem">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="text-center">
                            No Items in cart. Please login or register!
                        </h5>
                    </div>
                </div>
            </div>
        </section>

    </div>




@endsection

@push('footer-js')
    <script>
        let cartItemRoute = '{{ route('api.cart.list') }}';
    </script>
    <script src="{{ asset('js/pages/confirm-checkout.js') }}"></script>
@endpush


@extends('layouts.main')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>create account</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">create account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="register-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>create account</h3>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="theme-card">
                            <form class="theme-form">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="email">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="fname" placeholder="Full Name"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="review">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone NUmber"
                                               required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="review">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Enter your password" required>
                                    </div>
                                    <input type="submit" class="btn btn-solid mt-2" value="Create New">
                                </div>
                            </form>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection

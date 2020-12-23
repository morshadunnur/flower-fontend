@extends('layouts.main')

@section('content')
    <div id="productDetailsPage">

    </div>
@endsection

@push('footer-js')
    <script>
        let productId = '{{ $product->id }}';
        let productDetailsRoute = '{{ route('api.product.details') }}'
    </script>
    <script src="{{ asset('js/pages/productDetails.js') }}"></script>
@endpush

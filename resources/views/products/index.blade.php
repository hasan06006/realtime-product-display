@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product List</h1>

        @if(empty($products))
            <p>No products available.</p>
        @else
            <ul id="product-list">
                @foreach ($products as $product)
                    <li id="product-{{ $product['id'] }}">
                        <strong>{{ $product['title'] }}</strong> - ${{ $product['price'] }}
                        <p>{{ $product['description'] }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Pusher setup
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('products');
        channel.bind('ProductUpdated', function(data) {
            var product = data.product;
            var productList = document.getElementById('product-list');
            var newProduct = document.createElement('li');
            newProduct.innerHTML = `<strong>${product.name}</strong> - $${product.price}<p>${product.description}</p>`;
            productList.appendChild(newProduct);
        });
    </script>
@endsection


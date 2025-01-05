@extends('site.layout.master')
@section('title')
    @langucw('Payment')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    {{-- <li><a href="{{ route('home') }}">@langucw('home')</a></li> --}}
    {{-- <li> @langucw('contact us') </li> --}}
@endsection
@section('content')
@php
$data = $response->getData(true);
    $id = $data['id'];

    $shopperResultUrl = $data['shopperResultUrl'];
@endphp
    <form action="{{ $shopperResultUrl }}" class="paymentWidgets" data-brands="VISA MASTER"></form>

    <script>
        var wpwlOptions = {
            iframeStyles: {
                'card-number-placeholder': {
                    'color': '#ff0000',
                    'font-size': '16px',
                    'font-family': 'monospace'
                },
                'cvv-placeholder': {
                    'color': '#0000ff',
                    'font-size': '16px',
                    'font-family': 'Arial'
                }
            }
        }
    </script>
    <script async
        src="https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}">
    </script>
    @endsection


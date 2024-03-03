@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Delivery Times for Curriculum: {{ $curriculum->title }}</h1>
        @if ($deliveryTimes->isNotEmpty())
            <ul>
                @foreach($deliveryTimes as $deliveryTime)
                    <li>Delivery From: {{ $deliveryTime->delivery_from }}</li>
                    <li>Delivery To: {{ $deliveryTime->delivery_to }}</li>
                @endforeach
            </ul>
        @else
            <p>No delivery times found for this curriculum.</p>
        @endif
    </div>
@endsection
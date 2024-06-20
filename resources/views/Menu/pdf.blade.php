<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
</head>
<body>
    <h1 class="text-3xl font-bold mb-6">Menu</h1>
    @foreach($menuItems as $item)
        <div class="dish">
            <h2 class="dish-name">{{ $item->dish->DishName }}</h2>
            <p class="dish-description">{{ $item->dish->Description }}</p>
            <p class="dish-price">Prijs: €{{ number_format($item->dish->Price, 2) }}</p>
        </div>
        @if(($loop->iteration % 40) == 0) <!-- Adjust the number here to control the items per page -->
            <div class="page-break"></div>
        @endif
    @endforeach
    <div class="page-break"></div>
    <h1 class="text-3xl font-bold mb-6">Aanbiedingen</h1>
    @foreach($discounts as $discount)
        <div class="dish">
            <h2 class="dish-name">{{ $discount->dish->DishName }} - {{ $discount->DiscountPercentage }}% korting</h2>
            <p class="dish-description">{{ $discount->dish->Description }}</p>
            <p class="dish-price">Korting van: {{ $discount->StartDate }} tot {{ $discount->EndDate }}</p>
        </div>
        @if(($loop->iteration % 20) == 0) <!-- Adjust the number here to control the items per page -->
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
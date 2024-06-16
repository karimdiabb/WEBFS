<x-guest-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Menu</h1>
        @foreach($menuItems as $item)
            <div class="mb-6 p-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold">{{ $item->dish->DishName }}</h2>
                <p class="text-gray-700">{{ $item->dish->Description }}</p>
                <p class="text-gray-800 font-bold">Price: ${{ number_format($item->dish->Price, 2) }}</p>
            </div>
        @endforeach

        <div class="page-break"></div>

        <h1 class="text-3xl font-bold mb-6">Offers</h1>
        @foreach($discounts as $discount)
            <div class="mb-6 p-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold">{{ $discount->dish->DishName }} - {{ $discount->DiscountPercentage }}% off</h2>
                <p class="text-gray-700">{{ $discount->dish->Description }}</p>
                <p class="text-gray-800">Valid from: {{ $discount->StartDate }} to {{ $discount->EndDate }}</p>
            </div>
        @endforeach
    </div>
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</x-guest-layout>

<x-guest-layout>
    <div class="menu">
        <div class="buttons-container">
            <a href="{{ route('dishes.index') }}" class="styled-button">Selecteer Favoriete Gerechten</a>
            <a href="{{ route('menu.download') }}" class="styled-button">Download Menu</a>
        </div>
        @foreach ($images as $image)
            <img src="{{ url('images/menu/' . $image->getFilename()) }}" alt="Menu Image">
        @endforeach
    </div>
</x-guest-layout>

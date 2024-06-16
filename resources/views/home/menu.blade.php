<x-guest-layout>
    <div class="menu">
        @foreach ($images as $image)
            <img src="{{ url('images/menu/' . $image->getFilename()) }}" alt="Menu Image">
        @endforeach
    </div>
</x-guest-layout>

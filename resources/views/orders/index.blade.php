{{-- 4 divs:
    - searchable menu list with add to order button [items from db, top has search field to filter list, each list item
    dispalyes menu number, name, price, and add to order button]
    - order overview
    - optional note field
    - submit field with total and delete option.
    layout:
    -list left side
    -order overview right top, optional note field right middle, submit field right bottom --}}

<!-- resources/views/order.blade.php -->
<x-app-layout>
    <order-page :menu-items="{{ json_encode($menuItems) }}"></order-page>

</x-app-layout>

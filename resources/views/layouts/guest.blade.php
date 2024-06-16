<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
    <title>{{ config('app.name', 'De Gouden Draak') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/css/main-front.css'])
    @stack('css')
</head>

<body>
    <table class="main_table">
        <tr class="row">
            <td class="centered-text">
                <img src="{{ url('../images/dragon-small.png') }}" alt="Golden Dragon" class="spacer-height">
                <span>De Gouden Draak</span>
                <img src="{{ url('../images/dragon-small-flipped.png') }}" alt="Golden Dragon" class="spacer-height">
            </td>
            <td>
                <a href="paginas/aanbiedingen.html" class="link-style">
                    <div class="marquee-container">
                        <div class="marquee">
                            Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
                        </div>
                    </div>
                </a>
            </td>
            <td class="centered-text">
                <img src="{{ url('../images/dragon-small.png') }}" alt="Golden Dragon" class="spacer-height">
                <span>De Gouden Draak</span>
                <img src="{{ url('../images/dragon-small-flipped.png') }}" alt="Golden Dragon" class="spacer-height">
            </td>
        </tr>
    </table>


    <table class="main_table">
        <tr class="row-1">
            <td class="row" colspan="11"></td>
        </tr>
        <tr class="row row-2">
            <td class="spacer"></td>
            <td class="bordered border-left border-top"></td>
            <td class="bordered border-right border-top"></td>
            <td class="bordered border-right border-bottom"></td>
            <td class="border-top border-bottom" colspan="3"></td>
            <td class="bordered border-left border-bottom"></td>
            <td class="bordered border-left border-top"></td>
            <td class="bordered border-right border-top"></td>
            <td class="spacer"></td>
        </tr>
        <tr class="row row-3">
            <td class="spacer"></td>
            <td class="bordered border-left border-bottom"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td colspan="3"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td class="bordered border-right border-bottom"></td>
            <td class="spacer"></td>
        </tr>
        <tr class="row row-4">
            <td class="spacer"></td>
            <td class="bordered border-right border-bottom"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td class="bordered border-left border-top"></td>
            <td colspan="3"></td>
            <td class="bordered border-right border-top"></td>
            <td class="bordered border-left border-right border-top border-bottom"></td>
            <td class="bordered border-bottom"></td>
            <td class="spacer"></td>
        </tr>
        <tr class="row row-7">
            <td class="spacer"></td>
            <td class="bordered border-right border-left"></td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td colspan="3" class="text-center">
                <table class="content-table">
                    <tr>
                        <td colspan="3">
                            <p>
                                <img class="head-left" src="{{ url('../images/dragon-small.png') }}"
                                    alt="Golden Dragon">
                                <img class="head-right" src="{{ url('../images/dragon-small-flipped.png') }}"
                                    alt="Golden Dragon">
                                <span>Chinees Indische Specialiteiten</span>
                                <span class="title">De Gouden Draak</span>
                            </p>
                            <p>
                            <table class="menu-table">
                                <tr>
                                    <td>
                                        <a id="menu-link1" href="{{ route('menu') }}">Menukaart</a>
                                    </td>
                                    <td>
                                        <a id="menu-link2" href="{{ route('news') }}">Nieuws</a>
                                    </td>
                                    <td>
                                        <a id="menu-link3" href="{{ route('contact') }}">Contact</a>
                                    </td>
                                </tr>
                            </table>

                            </p>
                        </td>
                    </tr>
                    <tr class="spacer-padding">
                        <td colspan="3" class="spacer-height"></td>
                    </tr>
                    <tr class="spacer-padding">
                        <td class="spacer-width"></td>
                        <td class="promo">
                            {{ $slot }}
                        </td>
                        <td class="spacer-width"></td>
                    </tr>
                    @stack('tr')
                </table>
                <br>
                <div id="footer"><a href="paginas/contact_new.html">Naar Contact</a></div>
            </td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td class="bordered border-right border-left"></td>
            <td class="spacer"></td>
        </tr>

        <tr class="row row-4">
            <td class="spacer"></td>
            <td class="border-top border-right border-bottom"></td>
            <td class="border-left border-right border-bottom border-top"></td>
            <td class=""></td>
            <td colspan="3"></td>
            <td class=""></td>
            <td class="border-left border-top border-bottom border-right"></td>
            <td class="border-left border-top border-bottom"></td>
            <td class="spacer"></td>
        </tr>
        <tr class="row row-3">
            <td class="spacer"></td>
            <td class="border-left border-top border-right"></td>
            <td class="border-left border-right border-bottom border-top"></td>
            <td class="border-left border-right border-bottom border-top"></td>
            <td class="border-bottom" colspan="3"></td>
            <td class="border-left border-right border-bottom border-top"></td>
            <td class="border-left border-right border-bottom border-top"></td>
            <td class="border-left border-top border-right"></td>
            <td class="spacer"></td>
        </tr>

        <tr class="row row-2">
            <td class="spacer"></td>
            <td class="border-left border-bottom"></td>
            <td class="border-bottom"></td>
            <td class="border-left border-right"></td>
            <td class="border-bottom border-left border-right" colspan="3"></td>
            <td class="border-left border-right"></td>
            <td class="border-left border-bottom"></td>
            <td class="border-bottom border-right"></td>
            <td class="spacer"></td>
        </tr>
        <tr class="row-1">
            <td class="row" colspan="11"></td>
        </tr>

    </table>
</body>

</html>

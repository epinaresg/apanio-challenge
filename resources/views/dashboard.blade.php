<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>Apanio Challenge</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body id="app-container">
        <main id="app">

            <div class="container-fluid p-0">

                <nav class="pt-4 pb-4">

                    <figure class="text-center logo-container">
                        <img src="https://coincap.io/static/logos/black.svg" alt="Logo">
                    </figure>

                </nav>

                <section class="resument-asset">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <h1>{{ $cryptocurrency->name }} ({{ $cryptocurrency->symbol }})</h1>
                                <h2 id="v-price">{{ $cryptocurrency->price }}</h2>
                                <h3 class="{{ $cryptocurrency->change_percent_prev_price > 0 ? 'positive' : 'negative' }}"><span id="v-change-percent" >{{ $cryptocurrency->change_percent_prev_price }}</span>%</h3>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <span class="sub-header">Market Cap</span>
                                        <span class="numeral-text" id="v-market-cap">{{ $cryptocurrency->market_cap_usd }}</span>
                                    </div>
                                    <div class="col-4">
                                        <span class="sub-header">Volume (24Hr)</span>
                                        <span class="numeral-text" id="v-volumen-24-hrs">{{ $cryptocurrency->volume_usd_24_hours }}</span>
                                    </div>
                                    <div class="col-4">
                                        <span class="sub-header">Supply</span>
                                        <span class="numeral-text"><span id="v-supply">{{ $cryptocurrency->supply }}</span> {{ $cryptocurrency->symbol }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="mt-5">


                    <div class="container">
                        <div id="table-container">
                            @include('load-table')
                        </div>
                    </div>
                </section>

            </div>

        </main>


        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('e56a15992170c3210520', {
                cluster: 'us2'
            });

            var channel = pusher.subscribe('crypto-currency-dashboard-{{ config('broadcasting.connections.pusher.random_string') }}');
            channel.bind('asset-price-change', function(data) {

                $('#v-price').html(data.price);
                $('#v-change-percent').html(data.change_percent_prev_price);
                $('#v-market-cap').html(data.market_cap_usd);
                $('#v-volumen-24-hrs').html(data.volume_usd_24_hours);
                $('#v-supply').html(data.supply);

                $('#v-change-percent').closest('h3').removeClass('negative').removeClass('positive').addClass((data.change_percent_prev_price > 0) ? 'positive' : 'negative' );

                loadTable();
            });


            function loadTable() {
                var request = $.ajax({
                    url: "{{ url('load-table') }}",
                    method: "GET",
                    dataType: "html"
                });

                request.done(function( html ) {
                    $('#table-container').html(html);
                });

                request.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });
            }

        </script>
    </body>
    </html>

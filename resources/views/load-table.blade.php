<h4>Últimos {{ $lastPrices->count() }} cambios de precio</h4>
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hora de actualización</th>
            <th scope="col">Precio</th>
            <th scope="col">Market Cap</th>
            <th scope="col">Volumen (24Hr)</th>
            <th scope="col">Supply</th>
            <th scope="col">Max Supply</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lastPrices as $k => $cryptocurrencyPrice)

        <tr>
            <th scope="row">{{ abs($lastPrices->count() - $k) }}</th>
            <td>{{ $cryptocurrencyPrice->created_at->format('d/m/Y H:i:s') }} UTC</td>
            <td>{{ $cryptocurrencyPrice->price }} <small  class="{{ $cryptocurrencyPrice->change_percent_prev_price > 0 ? 'positive' : 'negative' }}">{{ $cryptocurrencyPrice->change_percent_prev_price }}%</small></td>
            <td>{{ $cryptocurrencyPrice->market_cap_usd }}</td>
            <td>{{ $cryptocurrencyPrice->volume_usd_24_hours }}</td>
            <td>{{ $cryptocurrencyPrice->supply }}</td>
            <td>{{ $cryptocurrencyPrice->max_supply }}</td>
        </tr>

        @endforeach

    </tbody>
</table>

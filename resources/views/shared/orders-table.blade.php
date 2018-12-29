<table class="table table-striped">
    <thead>
        <tr>
            <th>ID naročila </th>
            <th>Datum oddaje</th>
            <th>Datum potrditve</th>
            <th>Datum stornacije</th>
            <th>Status</th>
            <th>Cena</th>
            <th>Več</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td> {{$order->id}} </td>
                <td> {{\Carbon\Carbon::parse($order->submitted_at)->format('d. m. Y')}} </td>
                <td> {{isset($order->fulfilled_at) ? \Carbon\Carbon::parse($order->fulfilled_at)->format('d. m. Y') : "" }}</td>
                <td> {{isset($order->cancelled_at) ? \Carbon\Carbon::parse($order->cancelled_at)->format('d. m. Y') : "" }}</td>
                <td> {{$order->status}} </td>
                <td> {{$order->total_price}} $</td>
                <td><a href="{{ preg_match( '#^management/orders/#', Request::path() ) ? '/management/order/'.$order->id : '/order/'.$order->id }}" class="link">Preglej</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
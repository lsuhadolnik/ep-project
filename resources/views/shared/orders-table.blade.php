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
                <td> {{$order->submitted_at}} </td>
                <td> {{isset($order->fullfilled_at) ? $order->fullfilled_at : "" }}</td>
                <td> {{isset($order->cancelled_at) ? $order->cancelled_at : "" }}</td>
                <td> {{$order->status}} </td>
                <td> {{$order->total_price}} $</td>
                <td><a href="/order/{{$order->id}}" class="link">Preglej</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
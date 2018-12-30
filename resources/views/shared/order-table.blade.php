<table class="table table-striped">
    <thead>
        <tr>
            <th>Izdelek </th>
            <th>Količina</th>
            <th>Cena</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td> {{$product->name}} </td>
                <td> {{$product->quantity}} </td>
                <td> {{$product->price}} $</td>
            </tr>
        @endforeach
        <tr>
            <td ></td>
            <th >Skupaj</th>
            <td>{{$order->total_price}}</td>
        </tr>
    </tbody>
</table>
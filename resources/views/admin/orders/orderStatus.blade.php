<table class="table table-bordered">
    <tbody>
        @foreach($orderstatus as $order)
        <tr>
            <th>Order Status</th>
            <td>{{ $order->order_status }}</td>
            <td>{{ $order->order_status_date }}</td>
        </tr>
        <tr>
            <th>Recouncil Status</th>
            <td>{{ $order->recouncil_status }}</td>
            <td>{{ $order->recouncil_status_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
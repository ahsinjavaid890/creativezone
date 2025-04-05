<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="invoice-box">
        <header class="invoice-header">
            <div class="logo">
                <img src="{{ url('public/images/adminlogo.png') }}" alt="Logo"> <!-- Your logo -->
            </div>
            <div class="invoice-info">
                <h2>Invoice</h2>
                <p>Invoice #: INV-00{{ $data->id }}</p>
                <p>Date: {{ now()->format('Y-m-d') }}</p>
            </div>
        </header>
        <section class="billing-info">
            <div class="client-info">
                <h3>Billing To:</h3>
                <p>{{ $data->first_name }} {{ $data->last_name }}</p>
                <p>{{ $data->address }}</p>
                <p>{{ $data->city }}, {{ $data->state }}, {{ $data->zipcode }}</p>
            </div>
            <div class="company-info">
                <h3>From: JioWirless</h3>
            </div>
        </section>
        @php
            $item = DB::table('order_items')->where('order_id' , $data->id)->get();
        @endphp
        <table class="invoice-table">
            <thead>
                <tr>
                    <th class="text-center">Image</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">price</th>
                    <th class="text-center">quantity</th>
                    <th class="text-center">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalQuantity = 0;
                    $subamount = 0;
                    $totalshipping = 0;
                @endphp
                @foreach($item as $it)
                @php
                    $product = DB::table('buy_products')->where('id', $it->product_id)->first();
                    $image = DB::table('gallary_images')->where('object_id', $product->id)->first();
                    $imagesArray = json_decode($product->images, true);
                    $firstImage = $imagesArray[0] ?? null;
                    $totalQuantity += $it->quantity;
                    $totalamount = $it->price * $it->quantity;
                    $subamount += $totalamount;
                    $defaultshipping = DB::table('default_shippings')->where('id', $it->shipping_id)->first();
                    @endphp
                    @if($defaultshipping)
                        @php $totalshipping = $defaultshipping->price; @endphp
                    @endif
                <tr>
                    <td class="text-center">
                        @if($image)
                        <img src="{{ url('public/images') }}/{{ $image->image }}" class="image-thumbnail" width="50">
                        @elseif($product->type == 'accessories') <!-- Use == for comparison -->
                        <img src="{{ url('public/images') }}/{{ $firstImage }}" width="50" alt="Image">
                        @endif
                    </td>
                    <td>
                        @if($it->storage)
                        {{ $product->name }} - {{ $it->storage }} - {{ $it->color }} - {{ $it->best_find }} - {{ $it->condition }}
                        @elseif($product->type == 'accessories') 
                        {{ $product->name }}
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex">
                            <div class="price">
                                <p>${{ $it->price }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        {{ $it->quantity }}
                    </td>
                    <td class="text-center">
                        ${{ $totalamount }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <section class="totals">
            <p><strong>Quantity:</strong> {{ $totalQuantity  }}</p>
            <p><strong>Sub Amount:</strong> ${{ $subamount  }}</p>
            <p><strong>Shipping Fee:</strong> ${{ $totalshipping }}</p>
            <p><strong>Total Amount:</strong> ${{ $subamount + $totalshipping }}</p>
        </section>

        <footer class="invoice-footer">
            <p>Thank you for your purchase!</p>
            <p>If you have any questions, feel free to contact us at support@mobilestore.com.</p>
        </footer>
    </div>
    <style type="text/css">
        
    @media print {
            /* Hide navigation, buttons, etc. */
            .print-btn { display: none; }
        }
        /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #F9F9F9;
        padding: 20px;
    }

    .invoice-box {
        background-color: #FFFFFF;
        padding: 20px;
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #CCCCCC;
        border-radius: 8px;
        color: #010F1C;
    }

    h2, h3 {
        color: #010F1C;
    }

    /* Header */
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo img {
        max-width: 150px;
    }

    .invoice-info {
        text-align: right;
    }

    /* Billing Info */
    .billing-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .billing-info h3 {
        color: #1370F2;
    }

    /* Invoice Table */
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .invoice-table th {
        background-color: #1370F2;
        color: #FFFFFF;
        padding: 10px;
        text-align: left;
    }

    .invoice-table td {
        padding: 10px;
        border-bottom: 1px solid #CCCCCC;
    }

    .invoice-table tr:nth-child(even) {
        background-color: #F4F4F4;
    }

    /* Totals */
    .totals {
        text-align: right;
        font-size: 16px;
    }

    .totals p {
        margin: 5px 0;
    }

    /* Footer */
    .invoice-footer {
        text-align: center;
        margin-top: 20px;
        color: #010F1C;
    }

    .invoice-footer p {
        margin: 5px 0;
    }

    </style>
    <script>
        window.onload = function() {
            // Open print dialog
            window.print();

            // Check if the print dialog is closed
            setTimeout(function() {
                // Close the window/tab after the print dialog is closed or canceled
                window.close();
            }, 500); // Adjust timeout as necessary
        };
    </script>
</body>
</html>

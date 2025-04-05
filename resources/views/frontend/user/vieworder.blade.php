@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
<link rel="canonical" href="{{ Request::url() }}">
@endsection

@section('content')
<main>
   <section class="profile__area pt-120 pb-120">
      <div class="container">
         <div class="profile__inner p-relative">
            <div class="row">
               <div class="col-xxl-12 col-lg-12">
                  <div class="card card-shadow">
                     <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                           <h5 class="card-title text-white">Order No #{{ $data->id }}</h5>
                           <a href="{{ url('user/dashboard') }}" class="btn btn-light btn-sm">Back to Orders</a>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-hover text-center">
                              <thead class="bg-dark text-white">
                                 <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php
                                     $totalQuantity = 0;
                                     $subamount = 0;
                                     $totalshipping = 0;
                                 @endphp
                                 @foreach(DB::table('order_items')->where('order_id' , $data->id)->get() as $r)
                                 @php
                                    $product = DB::table('buy_products')->where('id' , $r->product_id)->first();
                                    $image = DB::table('gallary_images')->where('object_id', $product->id)->first();
                                    $imagesArray = json_decode($product->images, true);
                                    $firstImage = $imagesArray[0] ?? null;
                                    $defaultshipping = DB::table('default_shippings')->where('id', $r->shipping_id)->first();
                                    $totalQuantity += $r->quantity;
                                    $totalamount = $r->price * $r->quantity;
                                    $subamount += $totalamount;
                                 @endphp
                                 @php
                                     if($defaultshipping) $totalshipping += $defaultshipping->price;
                                 @endphp
                                 <tr>
                                    <td scope="row">
                                       @if($image)
                                       <img src="{{ url('public/images') }}/{{ $image->image }}" class="img-thumbnail shadow-sm" width="70">
                                       @elseif($product->type == 'accessories')
                                       <img src="{{ url('public/images') }}/{{ $firstImage }}" class="img-thumbnail shadow-sm" width="70" alt="Image">
                                       @endif
                                    </td>
                                    <td>
                                        @if($r->storage)
                                        <strong>{{ $product->name }}</strong><br>
                                        {{ $r->storage }} - {{ $r->color }} - {{ $r->best_find }} - {{ $r->condition }}
                                        @elseif($product->type == 'accessories')
                                        <strong>{{ $product->name }}</strong>
                                        @endif
                                     </td>
                                    <td>${{ number_format($r->price, 2) }}</td>
                                    <td>{{ $r->quantity }}</td> 
                                    <td>
                                       ${{ number_format($r->price * $r->quantity, 2) }}
                                    </td> 
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                        <div class="mt-4 text-end">
                           <h7>Shipping: ${{ number_format($defaultshipping->price, 2) }}</h7>
                           <h6>Subtotal: ${{ number_format($subamount + $defaultshipping->price, 2) }}</h6>
                           <h5>Total: ${{ number_format($subamount + $defaultshipping->price, 2) }}</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
@endsection
@section('style')
<style>
   .profile__area {
      background-color: #f7f7f7;
   }
   .card-shadow {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }
   .card-header {
      border-radius: 10px 10px 0 0;
      padding: 1rem 1.5rem;
   }
   .card-body {
      padding: 2rem 1.5rem;
   }
   .table-hover tbody tr:hover {
      background-color: #f0f0f0;
   }
   .table thead th {
      border-bottom: 2px solid #333;
   }
   .table tbody tr td {
      vertical-align: middle;
   }
   .btn-light {
      border: 1px solid #333;
      color: #333;
   }
   .btn-light:hover {
      background-color: #333;
      color: #fff;
   }
   .text-end h6, .text-end h5 {
      font-weight: 600;
   }

   /* Make table responsive */
   @media (max-width: 767px) {
      .table-responsive {
         border: 0;
      }
      .table {
         display: block;
         overflow-x: auto;
         white-space: nowrap;
      }
      .table th, .table td {
         min-width: 120px;
      }
   }
</style>
@endsection

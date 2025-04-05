@extends('frontend.layouts.main')
@section('title')
<title>My Orders - Dashboard</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<main>
   <section class="profile__area py-5">
      <div class="container">
         <div class="profile__inner position-relative">
            <div class="row justify-content-center">
               <div class="col-xxl-10 col-lg-12">
                  <div class="card shadow-sm border-0">
                     <div class="card-header order-card-header bg-dark text-white d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 text-white">My Orders</h5>
                        <i class="fas fa-box-open fa-2x"></i>
                     </div>
                     <div class="card-body p-4">
                        <div class="table-responsive">
                           <table class="table table-hover table-responsive-lg text-center custom-tables">
                              <thead class="bg-dark text-white">
                                 <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach(DB::table('product_orders')->where('email' , Auth::user()->email)->get() as $r)
                                 @php
                                    $order = DB::table('order_items')->where('order_id' , $r->id)->first();
                                    $product = DB::table('buy_products')->where('id' , $order->product_id)->first();
                                 @endphp
                                 <tr>
                                    <td>#{{ $r->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                       <span class="badge 
                                          @if($r->status === 'Completed') bg-success 
                                          @elseif($r->status === 'Pending') bg-warning
                                          @else bg-secondary 
                                          @endif">
                                          {{ $r->status }}
                                       </span>
                                    </td>
                                    <td class="text-center">
                                       <a href="{{ url('user/vieworder') }}/{{ $r->id }}" class="btn btn-sm btn-outline-primary">
                                          <i class="fas fa-eye"></i> View
                                       </a>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
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
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        border-bottom: 1px solid #e5e5e5;
        font-weight: bold;
    }

    .card-body {
        background-color: #ffffff;
    }

    /* Table Styling */
    .custom-tables th, .custom-tables td {
        padding: 18px 10px;
    }

    .custom-tables th {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #777;
    }

    .custom-tables tbody tr {
        border-bottom: 1px solid #e9ecef;
    }

    .custom-tables tbody tr:hover {
        background-color: #f1f3f5;
        transform: scale(1.01);
        transition: 0.2s ease;
    }

    /* Badge Design */
    .badge {
        font-size: 0.8rem;
        padding: 8px 12px;
        border-radius: 15px;
    }

    .bg-success {
        background-color: #28a745 !important;
        color: #fff;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: #fff;
    }

    .bg-secondary {
        background-color: #6c757d !important;
        color: #fff;
    }

    /* Button Customization */
    .btn-outline-dark {
        color: #333;
        border-color: #333;
    }

    .btn-outline-dark:hover {
        background-color: #333;
        color: white;
        transform: translateY(-3px);
        transition: 0.3s ease;
    }
    /* Responsive Design */
    @media (max-width: 767px) {
        .custom-tables th, .custom-tables td {
            font-size: 0.75rem;
        }
        .btn {
            font-size: 0.75rem;
        }
    }

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

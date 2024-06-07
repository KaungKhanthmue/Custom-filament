@php
    $order = App\Models\Order::find($orderId['orderId']?? null);
    $user = App\Models\User::find($order->user_id);
    $price = [];
    $total = 0;
    foreach($order->orderItems as $item)
    {
        $price []=$item->product->price;
    }
    $total = array_sum($price);

@endphp

<div class="">
<div class="w-full  dark:bg-gray-900 bg-white shadow-2xl rounded-xl">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center pb-8">
      <div class="dark:bg-gray-800 bg-white shadow-xl border-gray-100 border-y-2 dark:border-gray-800 rounded-xl items-center py-4">
        <img src="https://www.shutterstock.com/shutterstock/photos/2443650565/display_1500/stock-vector-colored-outline-invoice-icon-logo-vector-illustration-design-2443650565.jpg" alt="Company Logo" class="w-16 h-16 mx-14 rounded-xl">
        <h1 class="text-xl font-bold mx-4">Shopping For All</h1>
      </div>
      <div class="text-right">
        <p class="text-gray-600 dark:text-white">Invoice No: {{$order?->id}}</p>
        <p class="text-gray-600 dark:text-white">Date: {{$order?->created_at->format('d/m/y')}}</p>
      </div>
    </div>
    <div class="flex justify-between bg-white shadow-sm dark:bg-gray-900 dark:text-white border-y-2 border-gray-200 dark:border-gray-800 rounded-lg text-black rounded-lg p-4">
    <div class="">
    <h2 class="text-lg font-bold pb-2">OrderName:</h2>
      <p class="text-gray-900 dark:text-white">Customer Name</p>
      <p class="text-gray-900 dark:text-white">Customer Email</p>
      <p class="text-gray-900 dark:text-white">Service Human </p>
    </div>
    <div class="">
    <h2 class="text-lg font-bold pb-2">{{$order?->name}}</h2>
      <userIdp class="text-gray-900 dark:text-white">{{$user?->name}}</p>
      <p class="text-gray-900 dark:text-white">{{$user?->email}}</p>
      <p class="text-gray-900 dark:text-white"></p>
    </div>
    
    </div>
    <div class="mt-8">
      <table class="table-auto w-full border border-collapse">
        <thead>
          <tr class="dark:bg-gray-800  bg-gray-200 text-left">
            <th class="px-4 py-2">Item</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2 text-right">Qty</th>
            <th class="px-4 py-2 text-right">Price</th>
          </tr>
        </thead>
        <tbody>
          
          @if($order->orderItems)

          @foreach($order->orderItems as $orderItem)
          <tr>
            <td class="px-4 py-2 border border-gray-300">{{$orderItem?->product?->name}}</td>
            <td class="px-4 py-2 border border-gray-300">{{$orderItem?->product?->description}}</td>
            <td class="px-4 py-2 text-right border border-gray-300">1</td>
            <td class="px-4 py-2 text-right border border-gray-300">{{$orderItem?->product?->price}}</td>
          </tr>
          @endforeach
          @endif

          </tbody>
      </table>
    </div>
    <div class="flex justify-between mt-8">
      <div class="text-gray-600 dark:text-gray-100">
        <p>Subtotal: $<span id="subtotal"></span></p>
        </div>
      <div class="text-right font-bold">
        
        <p>Total: $<span id="total">{{$total}}</span></p>
        
      </div>
    </div>
  </div>
</div>

</div>
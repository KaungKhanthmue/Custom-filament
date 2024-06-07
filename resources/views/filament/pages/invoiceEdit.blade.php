@php
$user= App\Models\User::find($userId);
$order =App\Models\Order::where('name',$name)->with('orderItems.product')->first();

$price =[];
$total = 0;
$totalView = 0;

    if($productAll)
    {
        foreach($productAll as $product)
        {
        $price[] = $product->price;
        }
        $total = array_sum($price);
    }
    foreach($order->orderItems as $orderItem)
    {
      $price[] = $orderItem->product->price;
      $totalView = array_sum($price);
    }


@endphp

<div class="">
<div class="w-full  dark:bg-gray-900 bg-white shadow-2xl rounded-xl">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center pb-8">
      <div class="flex items-center">
        <img src="https://www.shutterstock.com/shutterstock/photos/2443650565/display_1500/stock-vector-colored-outline-invoice-icon-logo-vector-illustration-design-2443650565.jpg" alt="Company Logo" class="w-16 h-16 mr-4">
        <h1 class="text-xl font-bold">Shop</h1>
      </div>
      <div class="text-right">
        <p class="text-gray-600">Invoice #INV12345</p>
        <p class="text-gray-600">Date: 2024-06-07</p>
      </div>
    </div>
    <div class="flex justify-between bg-white shadow-sm dark:bg-gray-700 dark:text-white border-y-2 border-gray-200 dark:border-gray-800 rounded-lg text-black rounded-lg p-4">
    <div class="">
    <h2 class="text-lg font-bold pb-2">OrderName:</h2>
      <p class="text-gray-900 dark:text-white">Customer Name</p>
      <p class="text-gray-900 dark:text-white">Customer Email</p>
      <p class="text-gray-900 dark:text-white">Service Human </p>
    </div>
    <div class="">
    <h2 class="text-lg font-bold pb-2">{{$name}}</h2>
      <p class="text-gray-900 dark:text-white">{{$user?->name}}</p>
      <p class="text-gray-900 dark:text-white">{{$user?->email}}</p>
      <p class="text-gray-900 dark:text-white">{{$authUser}}</p>
    </div>
    
    </div>
    <div class="mt-8">
      <table class="table-auto w-full border border-collapse">
        <thead>
          <tr class="dark:bg-gray-700  bg-gray-200 text-left">
            <th class="px-4 py-2">Item</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2 text-right">Qty</th>
            <th class="px-4 py-2 text-right">Price</th>
          </tr>
        </thead>
        <tbody>
          
          @if($order->orderItems && $productAll == null)

          @foreach($order->orderItems as $orderItem)
          <tr>
            <td class="px-4 py-2 border border-gray-300">{{$orderItem?->product?->name}}</td>
            <td class="px-4 py-2 border border-gray-300">{{$orderItem?->product?->description}}</td>
            <td class="px-4 py-2 text-right border border-gray-300">1</td>
            <td class="px-4 py-2 text-right border border-gray-300">{{$orderItem?->product?->price}}</td>
          </tr>
          @endforeach
          @else
          @if($productAll)
          @foreach($productAll as $product)
          <tr>
            <td class="px-4 py-2 border border-gray-300">{{$product?->name}}</td>
            <td class="px-4 py-2 border border-gray-300">{{$product?->description}}</td>
            <td class="px-4 py-2 text-right border border-gray-300">1</td>
            <td class="px-4 py-2 text-right border border-gray-300">{{$product?->price}}</td>
          </tr>
          @endforeach
          @endif
          @endif

          </tbody>
      </table>
    </div>
    <div class="flex justify-between mt-8">
      <div class="text-gray-600 dark:text-gray-100">
        <p>Subtotal: $<span id="subtotal"></span></p>
        </div>
      <div class="text-right font-bold">
        @if($productAll)
        <p>Total: $<span id="total">{{$total}}</span></p>
        @else
        <p>Total: $<span id="total">{{$totalView}}</span></p>
        @endif
      </div>
    </div>
  </div>
</div>

</div>
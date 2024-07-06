<x-filament-panels::page>
    <!-- component -->
    <div class="flex gap-4 flex-wrap mx-auto justify-center">
        @foreach($this->productList as $product)
        <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 dark:bg-gray-800 rounded-md">
            <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$product->name}}</div>
                <p class="text-grey-darker text-base">
                    {{$product->description}}
                </p>
                <div class="flex my-2">
                    <div class="">
                        <p class="font-bold text-lg">Category </p>
                        <p class="font-bold text-lg">Brand</p>
                        <p class="font-bold text-lg">Price</p>
                    </div>
                    <div class="">
                        <p class="ml-2 text-sm mt-1">: {{$product->category->name}}</p>
                        <p class="ml-2 text-sm mt-1">: {{$product->brand->name}}</p>
                        <p class="ml-2 text-sm mt-1">: {{(int)$product->price}} Ks</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center py-2 pl-1">
                <div class="flex items-center">
                    <img src="https://tailwindcss.com/img/card-top.jpg" class="w-10 h-10 bg-red-300 rounded-full"
                        alt="">
                    <p class="ml-2 mt-3 ">{{$product->user->name}}</p>
                </div>
                <div class="ml-auto mt-3">
                    <p class="text-blue-400 mr-2 font-thin">{{ $product->created_at->diffForHumans() }}</p>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    <div class="flex items-center justify-end pr-[90px]">
        {{ $this->productList->links()}}
    </div>

</x-filament-panels::page>
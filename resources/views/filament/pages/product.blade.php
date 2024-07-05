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
            </div>
            <div class="px-6 py-4">

            </div>
        </div>
        @endforeach
    </div>
    <div class="flex items-center justify-end pr-[90px]">
        {{ $this->productList->links()}}
    </div>

</x-filament-panels::page>
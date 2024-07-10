<x-filament-panels::page class="2xl:w-[1880px] xl:w-[1250px] lg:w-[1100px]">
    <div class="container mx-auto bg-gray-700 h-[1000px]">
        <div class=" p-2 w-full  bg-gray-600">
            <img src="{{ Storage::url($this->authUser()->cover_image) }}" alt="User Cover Image"
                class="w-full h-[400px]">

            <div class="flex justify-center  border-bottom-1 border-black">
                <div class="">
                    <div class="font-bold text-4xl pt-[80px]">{{$this->authUser->name}}</div>
                    <div class="flex justify-center">(kaung kaung)</div>
                </div>
            </div>
            <div class=" w-full h-[80px] flex justify-between">
                <div class=" py-4 px-4 flex gap-4">
                    <button class="w-[100px] h-[40px] bg-blue-500 rounded-md">Add Story</button>
                    <div class="w-[100] h-[40px] bg-gray-500 rounded-md">
                        {{($this->editAction)(['userId'=>$this->authUser->id])}}
                    </div>
                </div>
                <div class="py-4 px-4">
                    <button class="w-[100px] h-[50px] bg-gray-500 rounded-md">...</button>
                </div>
            </div>
            <div class=" w-full h-[40px] flex px-4">
                <button class="w-[100px] h-[40px] bg-blue-200 bg-opacity-25 rounded-xl text-black ml-2">Post</button>
                <button class="w-[100px] h-[40px]  text-black ml-2">Photos</button>
                <button class="w-[100px] h-[40px]  text-black ml-2">Videos</button>
            </div>
            <div class="w-full px-4 mt-4">
                <h1 class="font-bold text-xl">Detail</h1>
                <div class="">
                    <div class="flex">
                        <h1 class="font-bold text-md mr-8">Joinded Date </h1>
                        <p>: {{$this->authUser->created_at->format('D-M-Y')}}</p>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold text-md mr-8">Follower Count</h1>
                        <p>: Follower 145</p>
                    </div>
                </div>
            </div>
            <div class="w-full  bg-black mt-4">
                <div class="grid grid-cols-6 gap-4 p-4">
                    @foreach($this->authUser->userOneFriend as $friends)
                    <div class="w-[100%] h-[220px] bg-white shadow-md p-1 rounded-md">
                        <div class=""><img src="{{$friends->profile_image}}" alt="" class="w-full h-[70%]">
                        </div>
                        <div class="text-black">
                            <p class="font-bold text-md">{{$friends->name}}</p>
                            <p class="font-thin text-xs">{{$friends->email}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full h-[100px] bg-gray-300"></div>
        </div>
        <div class="bg-black w-[300px] h-[300px] p-1 rounded-full z-10 absolute top-[350px] left-[42%] ">
            <img src="{{ Storage::url($this->authUser()->profile_image) }}" class="w-[290px] h-[290px] rounded-full"
                alt="User Profile Image">
        </div>

    </div>
</x-filament-panels::page>
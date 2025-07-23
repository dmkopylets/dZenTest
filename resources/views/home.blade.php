<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
?>

<x-app-layout>
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @foreach($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @endforeach

        {{$posts->onEachSide(1)->links()}}

    </section>



    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">About Us</p>
            <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dicta eaque eveniet fuga hic illum impedit itaque, laboriosam numquam odit quaerat qui quidem quisquam suscipit tempora vero voluptas voluptatem voluptates?</p>
            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center">
                Get to know us
            </a>
        </div>

    </aside>
</x-app-layout>

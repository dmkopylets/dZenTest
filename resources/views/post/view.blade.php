<x-app-layout :meta-title="$post->meta_title ?: $post->title" :meta-description="$post->meta_description">
        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col px-3">

            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="{{$post->getThumbnail()}}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                       Якась категорія
                    <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                        {{$post->title}}
                    </h1>
                    <p href="#" class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on
                        {{$post->getFormattedDate()}} | {{ $post->human_read_time }}
                    </p>
                    <div>
                        {!! $post->body !!}
                    </div>
                </div>
            </article>

            <livewire:comments :post="$post"/>
        </section>
</x-app-layout>

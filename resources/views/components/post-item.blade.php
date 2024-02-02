<article class="bg-white    flex flex-col shadow my-4">
    <!-- Article Image -->
    <a href="{{route('article.view', $post)}}" class="hover:opacity-75">

    <div class="bg-white flex flex-col justify-start p-6">

        <a href="{{route('article.view', $post)}}" class="text-3xl font-bold hover:text-gray-700 pb-4">
            {{$post->title}}
        </a>
        @if ($showAuthor)
            <p href="#" class="text-sm pb-3">
                By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on
                {{$post->getFormattedDate()}} | {{ $post->human_read_time }}
            </p>
        @endif
        <a href="{{route('article.view', $post)}}" class="pb-6">
            {{$post->shortBody()}}
        </a>
        <a  href="{{route('article.view', $post)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                class="fas fa-arrow-right"></i></a>
    </div>
</article>

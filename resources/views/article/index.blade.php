<x-app-layout :meta-title="'The Articles List'"
              :meta-description="'All Articles'">
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3  px-3">
            <div class=" flex flex-col items-center">
                @foreach($articles as $article)
                    <x-post-item :post="$article"/>
                @endforeach
            </div>

        </section>
    </div>
</x-app-layout>

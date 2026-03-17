@if ($popularTags)
    <div class="mb-4 dark:bg-[#212121] bg-white rounded-lg mt-2 p-8 h-max">
        <h2 class="text-xl font-semibold dark:text-gray-300 mb-3">Popular tags</h2>
        <div class="flex items-center gap-1 flex-wrap">
            @foreach ($popularTags as $tag)
                <span class="text-white bg-gray-500 dark:bg-gray-700 px-3 py-1 rounded">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
@endif

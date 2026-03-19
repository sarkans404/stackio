<div>
    <x-activity-card :questionsQty="$questionsQty" :answersQty="$answersQty" :commentQty="$commentQty" :userQty="$userQty" />

    <x-popular-tags-card :popularTags="$popularTags" />

    @if (Auth::check() && $recentPosts->isNotEmpty())
        <x-recent-card :recentPosts="$recentPosts" />
    @endif
</div>

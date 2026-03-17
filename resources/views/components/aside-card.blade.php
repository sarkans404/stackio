<div>
    <x-activity-card :questionsQty="$questionsQty" :answersQty="$answersQty" :commentQty="$commentQty" :userQty="$userQty" />

    <x-popular-tags-card :popularTags="$popularTags" />

    <x-recent-card :question="$question" />
</div>

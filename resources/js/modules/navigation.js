export default function initNavigation() {

    document.addEventListener("click", (e) => {

        const card = e.target.closest(".post-card");
        if (!card) return;

        if (
            e.target.closest(
                "a, button, .menu, .menu-btn, .action-btn, .share-btn, .comment-btn, .response-input, .response-block, .form-comment"
            )
        ) return;

        window.location.href = `/questions/${card.dataset.id}`;

    });

}
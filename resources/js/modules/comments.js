export default function initComments() {

    const commentBtn = document.getElementById("comment-btn");
    const input = document.getElementById("response-input");
    const submitBlock = document.getElementById("response-block");
    const resetBtn = document.getElementById("reset-btn");

    if (commentBtn && input) {

        commentBtn.addEventListener("click", () => {
            input.focus();
        });

    }

    if (input && submitBlock) {

        input.addEventListener("focus", () => {
            submitBlock.classList.remove("hidden");
        });

    }

    if (resetBtn && submitBlock) {

        resetBtn.addEventListener("click", () => {
            submitBlock.classList.add("hidden");
        });

    }

    const inputs = document.querySelectorAll(".response-input");
    const submitBlocks = document.querySelectorAll(".response-block");
    const forms = document.querySelectorAll(".form-comment");

    inputs.forEach((input, index) => {

        input.addEventListener("focus", () => {
            submitBlocks[index]?.classList.remove("hidden");
        });

    });

    document.querySelectorAll(".reply-btn").forEach((reply, index) => {

        reply.addEventListener("click", () => {

            const form = forms[index];

            form?.classList.toggle("hidden");

        });

    });

    document.querySelectorAll(".reset-btn").forEach((reset, index) => {

        reset.addEventListener("click", () => {

            submitBlocks[index]?.classList.add("hidden");

        });

    });

}
export default function initClipboard() {

    document.addEventListener("click", (e) => {

        const btn = e.target.closest(".copy-link-btn");
        if (!btn) return;

        const url = btn.dataset.url;

        navigator.clipboard.writeText(url);

    });

}
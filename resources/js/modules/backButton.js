export default function initBackButton() {

    const back = document.getElementById("back-btn");

    if (!back) return;

    back.addEventListener("click", () => {
        if (document.referrer && document.referrer !== window.location.href) {
            window.location.href = document.referrer;
        } else {
            window.location.href = "/";
        }
    });

}
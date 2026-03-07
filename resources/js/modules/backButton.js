export default function initBackButton() {

    const back = document.getElementById("back-btn");

    if (!back) return;

    back.addEventListener("click", () => {
        window.location.href = "/";
    });

}
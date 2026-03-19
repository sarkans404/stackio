export default function initSidebar() {

    const sidebar = document.querySelector("aside");
    const content = document.querySelector(".main-content");
    const icon = document.querySelector("#sidebar-toggle svg");
    const toggle = document.getElementById("sidebar-toggle");

    if (!sidebar || !toggle) return;

    const state = localStorage.getItem("sidebar");

    if (state === "open") {
        sidebar.classList.remove("-translate-x-[92%]");
        sidebar.classList.add("translate-x-0");
        icon?.classList.remove("rotate-180");
        content?.classList.replace("translate-x-0", "translate-x-20");
    }
    if (state === "closed"){
        icon?.classList.add("rotate-180");
    }

    toggle.addEventListener("click", () => {

        const isOpen = sidebar.classList.contains("translate-x-0");

        if (isOpen) {
            sidebar.classList.add("-translate-x-[92%]");
            sidebar.classList.remove("translate-x-0");
            icon?.classList.add("rotate-180");
            content?.classList.replace("translate-x-20", "translate-x-0");

            localStorage.setItem("sidebar", "closed");
        } else {
            sidebar.classList.remove("-translate-x-[92%]");
            sidebar.classList.add("translate-x-0");
            icon?.classList.remove("rotate-180");
            content?.classList.replace("translate-x-0", "translate-x-20");

            localStorage.setItem("sidebar", "open");
        }

    });
}
export default function initMenus() {

    document.addEventListener("click", (e) => {

        const actionBtn = e.target.closest(".action-btn");
        const shareBtn = e.target.closest(".share-btn");

        if (actionBtn) {

            const menu = actionBtn.parentElement.querySelector(".action-menu");

            document.querySelectorAll(".menu").forEach(m => {
                if (m !== menu) m.classList.add("hidden");
            });

            menu?.classList.toggle("hidden");

            return;
        }

        if (shareBtn) {

            const menu = shareBtn.parentElement.querySelector(".share-menu");

            document.querySelectorAll(".menu").forEach(m => {
                if (m !== menu) m.classList.add("hidden");
            });

            menu?.classList.toggle("hidden");

            return;
        }

        if (!e.target.closest(".menu")) {

            document.querySelectorAll(".menu").forEach(menu => {
                menu.classList.add("hidden");
            });

        }

    });

}
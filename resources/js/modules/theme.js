export default function initTheme() {

    const storedTheme = localStorage.getItem("theme");

    if (storedTheme === "dark") {
        document.documentElement.classList.add("dark");
    }

    const toggle = document.getElementById("theme-toggle");
    if (!toggle) return;

    toggle.addEventListener("click", () => {

        const isDark = document.documentElement.classList.toggle("dark");

        localStorage.setItem("theme", isDark ? "dark" : "light");

    });
}
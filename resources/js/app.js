import "./bootstrap";

import initTheme from "./modules/theme";
import initSidebar from "./modules/sidebar";
import initNavigation from "./modules/navigation";
import initMenus from "./modules/menus";
import initComments from "./modules/comments";
import initClipboard from "./modules/clipboard";
import initBackButton from "./modules/backButton";
import initEditResponses from "./modules/editResponses";
import initVote from "./ajax/vote";

document.addEventListener("DOMContentLoaded", () => {
    initTheme();
    initSidebar();
    initNavigation();
    initBackButton();
    initMenus();
    initComments();
    initClipboard();
    initEditResponses();
    initVote();
});
import "./bootstrap";

import initTheme from "./modules/theme";
import initSidebar from "./modules/sidebar";
import initNavigation from "./modules/navigation";
import initGallery from "./modules/gallery";
import initMenus from "./modules/menus";
import initComments from "./modules/comments";
import initClipboard from "./modules/clipboard";
import initBackButton from "./modules/backButton";
import initEditResponses from "./modules/editResponses";
import initAvatarPreview from "./modules/avatarPreview";
import initImageUploadPreview from "./modules/uploadPreview";
import initVote from "./ajax/vote";
import initSave from "./ajax/save";
import initHide from "./ajax/hide";
import initClearRecent from "./ajax/clearRecent";
import initUploadRemove from "./ajax/uploadRemove";

document.addEventListener("DOMContentLoaded", () => {
    initTheme();
    initSidebar();
    initNavigation();
    initGallery();
    initBackButton();
    initMenus();
    initComments();
    initClipboard();
    initEditResponses();
    initAvatarPreview();
    initVote();
    initSave();
    initHide();
    initClearRecent();
    initImageUploadPreview();
    initUploadRemove();
});
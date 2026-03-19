export function initNotice(message, type = 'info', duration = 1500) {
    const notice = document.querySelector('#notice');

    const wrapper = document.createElement('div');
    wrapper.className = `
        relative overflow-hidden flex items-center gap-3
        px-4 py-3 rounded-xl shadow-md
        text-sm font-medium
        transition-all duration-300 opacity-0 translate-y-2
        ${getTypeStyles(type)}
    `;

    const text = document.createElement('span');
    text.textContent = message;

    const progress = document.createElement('div');
    progress.className = `
        absolute bottom-0 left-0 h-1 w-full
        bg-black/20 dark:bg-white/20
    `;

    const progressInner = document.createElement('div');
    progressInner.className = `
        h-full w-full origin-left
        bg-black/50 dark:bg-white/50
    `;

    progressInner.style.transform = 'scaleX(1)';

    progress.appendChild(progressInner);
    wrapper.appendChild(text);
    wrapper.appendChild(progress);

    notice.appendChild(wrapper);

    requestAnimationFrame(() => {
        wrapper.classList.remove('opacity-0', 'translate-y-2');
    });

    progressInner.offsetWidth;

    progressInner.style.transition = `transform ${duration}ms linear`;
    progressInner.style.transform = 'scaleX(0)';

    setTimeout(() => {
        wrapper.classList.add('opacity-0', 'translate-y-2');

        setTimeout(() => wrapper.remove(), 300);
    }, duration);
}


function getTypeStyles(type) {
    switch (type) {
        case 'success':
            return 'bg-green-500/90 text-white';
        case 'error':
            return 'bg-red-500/90 text-white';
        case 'warning':
            return 'bg-yellow-400/90 text-black';
        default:
            return 'bg-gray-300 dark:bg-neutral-700 text-black dark:text-white';
    }
}
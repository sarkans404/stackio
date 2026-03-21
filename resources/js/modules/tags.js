import { initNotice } from "../components/actionNotice";

export default function initTags() {
    const input = document.getElementById('tag');
    if(!input) return;
    
    const container = document.getElementById('tagsContainer');
    const form = input.closest('form');

    if(!container) return;

    let tags = [];

    input.addEventListener('keydown', (e) => {
         if (e.key === ' ' || e.key === 'Enter' || e.key === ',') {
              if(tags.length >= 5){
                   initNotice('Max 5 tags');
                   return;
              }
              e.preventDefault();

            let value = input.value.trim().toLowerCase();

            if (!value) return;

            if (tags.includes(value)) {
                input.value = '';
                return;
            }

            tags.push(value);
            renderTags();
            input.value = '';
        }
    });

    function renderTags() {
        container.innerHTML = '';

        tags.forEach((tag, index) => {
            const el = document.createElement('div');

            el.className = 'text-white bg-gray-500 dark:bg-gray-700 px-3 py-1 rounded flex items-center gap-2';

            el.innerHTML = `
                <span>${tag}</span>
                <button type="button" data-index="${index}" class="text-sm hover:text-red-500 cursor-pointer">✕</button>
                <input type="hidden" name="tags[]" value="${tag}">
            `;

            container.appendChild(el);
        });
    }

    container.addEventListener('click', (e) => {
        if (!e.target.matches('button')) return;

        const index = e.target.dataset.index;

        tags.splice(index, 1);
        renderTags();
    });
}
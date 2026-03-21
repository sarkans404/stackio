import { initNotice } from "../components/actionNotice";

export default function initTagsEdit() {
    const input = document.getElementById('tag');
    const container = document.getElementById('tagsEditContainer');

    if(!container) return;
    if(!input) return;

    let tags = [];

    container.querySelectorAll('input[name="tags[]"]').forEach(input => {
        tags.push(input.value.toLowerCase());
    });
    render();

    input.addEventListener('keydown', (e) => {
        if ([' ', 'Enter', ','].includes(e.key)) {
            e.preventDefault();

            if(tags.length >= 5){
                   initNotice('Max 5 tags');
                   return;
              }

            let value = input.value.trim().toLowerCase();
            if (!value) return;

            if (tags.includes(value)) {
                input.value = '';
                return;
            }

            tags.push(value);
            render();
            input.value = '';
        }
    });

    function render() {
        container.innerHTML = '';

        tags.forEach((tag, index) => {
            const el = document.createElement('div');

            el.className = 'text-white bg-gray-500 dark:bg-gray-700 px-3 py-1 rounded flex items-center gap-2';

            el.innerHTML = `
                <span>${tag}</span>
                <button type="button" data-index="${index}" class="remove-tag text-sm hover:text-red-500">✕</button>
                <input type="hidden" name="tags[]" value="${tag}">
            `;

            container.appendChild(el);
        });
    }

    container.addEventListener('click', (e) => {
        if (!e.target.classList.contains('remove-tag')) return;

        const index = e.target.dataset.index;

        tags.splice(index, 1);
        
        render();
    });
}
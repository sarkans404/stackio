import { initNotice } from "../components/actionNotice";

export default function initImageUploadPreview() {

    const input = document.getElementById('img');
    const preview = document.getElementById('previewContainer');

    if (!input || !preview) return;

    let files = [];

    input.addEventListener('change', (e) => {
        const newFiles = Array.from(e.target.files);
        if (files.length + newFiles.length > 10) {
            initNotice('Max 10 images');
            return;
        }
        

        newFiles.forEach(file => {
            if (file.size >  15000000){
                initNotice('Max 15MB per image');
                return;
            }
            if (!file.type.startsWith('image/')) return;

            files.push(file);
        });

        renderPreview();
        syncInputFiles();
    });

    function renderPreview() {
        preview.innerHTML = '';

        files.forEach((file, index) => {
            const url = URL.createObjectURL(file);

            const div = document.createElement('div');
            div.className = 'relative group';

            div.innerHTML = `
                <img src="${url}" class="w-full h-28 object-cover rounded-lg">

                <button type="button"
                    class="absolute top-1 right-1 bg-black/60 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 duration-200"
                    data-index="${index}">
                    ✕
                </button>
            `;

            preview.appendChild(div);

            div.querySelector('img').onload = () => URL.revokeObjectURL(url);
        });
    }

    preview.addEventListener('click', (e) => {
        if (!e.target.matches('button')) return;

        const index = e.target.dataset.index;
        files.splice(index, 1);
            initNotice('Image has removed!', 'success');

        renderPreview();
        syncInputFiles();
    });

    function syncInputFiles() {
        const dataTransfer = new DataTransfer();

        files.forEach(file => dataTransfer.items.add(file));

        input.files = dataTransfer.files;
    }
}
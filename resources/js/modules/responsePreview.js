import { initNotice } from "../components/actionNotice";

export default function initResponseUpload() {
     const responseBlock = document.querySelectorAll('.responseCont');

     responseBlock.forEach(container => {

          const input = container.querySelector('.inputResponse');
          const preview = container.querySelector('.responsePreview');
          const resetBtn = container.querySelector('.reset-btn');

          if(!input || !preview) return;
               
          let file;
          
          input.addEventListener('change', (e) => {
               file = e.target.files[0];
               
               if(file.size > 10000000){
                    initNotice('Max 10MB image size');
                    return;
               }
               if(!file.type.startsWith('image/')) return;

               const removeInput = container.querySelector('.remove-image-input');
               if(removeInput) removeInput.value = '0';
               
               renderPreview();
               syncInputFile();
          });
          

          

          
          function renderPreview(){
               preview.innerHTML = '';

               if (!file) {
                    preview.classList.add('hidden');
                    return;
               }

               preview.classList.remove('hidden');

               const url = URL.createObjectURL(file);

               const div = document.createElement('div');
               div.className = 'relative group';

               div.innerHTML = `
                    <img src="${url}" class="w-full h-28 object-cover rounded-lg">

                    <button type="button"
                         class="absolute top-1 right-1 bg-black/60 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 duration-200">
                         ✕
                    </button>
               `;

               preview.appendChild(div);

               div.querySelector('img').onload = () => URL.revokeObjectURL(url);
          }

          preview.addEventListener('click', (e) => {
               if(!e.target.matches('button')) return;

               file = null;
               initNotice('Image has removed!', 'success');

               preview.innerHTML = '';
               preview.classList.add('hidden');

               
               const removeInput = container.querySelector('.remove-image-input');
               if(removeInput) removeInput.value = '1';

               syncInputFile();
          });

          resetBtn?.addEventListener('click', (e) => {
               if(!e.target.matches('button')) return;

               preview.classList.contains('hidden')? '' : preview.classList.add('hidden');
               file = null;
               preview.innerHTML = '';

               syncInputFile();
          })

          

          function syncInputFile(){
               const dataTransfer = new DataTransfer();

               if (file) {
                    dataTransfer.items.add(file);
               }

               input.files = dataTransfer.files;
          }

     });
}
import { initNotice } from "../components/actionNotice"

export default function initAvatarPreview(){
     const avatarInput = document.getElementById('avatarInput');
     const avatarPreview = document.getElementById('avatarPreview');

     if(!avatarInput || !avatarPreview) return;

     avatarInput.addEventListener('change', () => {
          const file = avatarInput.files[0];

          if(file.size > 2 * 1024 * 1024){
               const text = document.createElement('span');
               text.classList.add('text-red-500', 'text-sm');
               text.innerText = "Cannot upload more than 2MB image for avatar!";
               document.getElementById('avatarError').appendChild(text);
          }
          
          if(!file) return;

          const url = URL.createObjectURL(file);
          avatarPreview.src = url;
          avatarPreview.onload = () => URL.revokeObjectURL(url);

          avatarPreview.classList.add('ring-2', 'dark:ring-yellow-500', 'ring-blue-500');
     });
}
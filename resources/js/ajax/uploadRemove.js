import { initNotice } from "../components/actionNotice";

export default function initUploadRemove(){
     const uploadedCont = document.querySelectorAll('.uploadedCont');
     document.querySelectorAll('.uploadedRemoveBtn').forEach((btn, index) => {
          btn.addEventListener('click', async () => {
               const imageId = btn.dataset.id;
               if(!imageId){
                    initNotice('Lost image id', 'error');
                    return;
               }

               try{
                    const res = await fetch('/upload/remove', {
                         url: '/upload/remove',
                         method: 'POST',
                         headers:{
                              'Content-Type': 'application/json',
                              'X-CSRF_TOKEN': document.querySelector('meta[name="csrf-token"]').content

                         },
                         body: JSON.stringify({
                              id: imageId,
                         }),
                    });

                    const data = await res.json();

                    if(data.success){
                         initNotice(data.success, 'success');
                         uploadedCont[index].remove();
                    }
                    if(data.error){
                         initNotice(data.error, 'error');
                    }
                    
               } catch(err){
                    initNotice('Cannot remove image!', 'error');
                    console.log(err);
               }
          });
     });
}
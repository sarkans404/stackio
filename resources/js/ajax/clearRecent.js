import { initNotice } from "../components/actionNotice";

export default function initClearRecent() {
     const btn = document.querySelector('#clearRecentBtn');
     btn.addEventListener('click', async () => {
          try{
               const res = await fetch('/recent/clear', {
                    method: 'POST',
                    headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF_TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                         user_id: btn.dataset.userId,
                    }),
               });

               const data = await res.json();
               
               if(data.success){
                    initNotice(data.success, 'success')

                    document.querySelector('#recentCont').remove();
               }
               if(data.error){
                    initNotice(data.error, 'error')
               }
               
               
          } catch(err){
               initNotice(err, 'error');
               console.log(err);
          }
     });
}
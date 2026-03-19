import { initNotice } from '../components/actionNotice';

export default function initHide(){
      document.querySelectorAll('.hideBtn').forEach( btn => {
          btn.addEventListener('click', async () => {
               const userId = btn.dataset.userId ?? null;
               const questionId = btn.dataset.questionId ?? null;

               try{
                    const res = await fetch('/question/hide', {
                         url: '/question/hide',
                         method: 'POST',
                         headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF_TOKEN': document.querySelector('meta[name="csrf-token"]').content
                         },
                         body: JSON.stringify({
                              user_id: userId,
                              question_id: questionId,
                         }),
                    });

                    const data = await res.json();
                    const textBtn = btn.querySelector('span');

                    if(data.success){
                         initNotice(data.success, 'success');

                         if(data.action === 'unhide'){
                              btn.classList.remove('dark:text-yellow-500', 'text-blue-500')
                              textBtn.innerText = 'Hide Post';
                         }
                         if(data.action === 'hide'){
                              btn.classList.add('dark:text-yellow-500', 'text-blue-500')
                              textBtn.innerText = 'Hidden';
                         }
                    }
                    if(data.error){
                         initNotice(data.error, 'error');
                    }
                    
               } catch(err){
                    initNotice('Catch an error on a hide post!');
                    console.log(err);
               }
          });
      });
}
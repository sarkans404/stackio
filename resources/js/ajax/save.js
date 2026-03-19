import { initNotice } from '../components/actionNotice.js';

export default function initSave(){
     document.querySelectorAll('.saveBtn').forEach((btn) => {       
          btn.addEventListener('click', async () => {
               const userId = btn.dataset.userId ?? null;
               const questionId = btn.dataset.questionId ?? null;

               try {
                    const res = await fetch('/question/save', {
                         url: '/question/save',
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
                    const text = btn.querySelector('span');
                    

                    if(data.success){
                         initNotice(data.success, 'success');

                         if(data.action === 'unsaved'){
                              btn.classList.remove('dark:text-yellow-500', 'text-blue-500')
                              text.innerText = 'Save';
                         }
                         if(data.action === 'saved'){
                              btn.classList.add('dark:text-yellow-500', 'text-blue-500');
                              text.innerText = 'Saved';
                         }
                    }
                    if(data.error){
                         initNotice(data.error, 'success');
                    }
               } catch(err){
                    initNotice('Catch an error on a save post!')
                    console.log(err);
               }
          });
     });
}
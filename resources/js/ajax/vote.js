import { initNotice } from '../components/actionNotice.js';

export default function initVote(){
    
    document.querySelectorAll('.vote').forEach((btn) => {

        btn.addEventListener('click', async () => {

            const questionId = btn.dataset.questionId ?? null;
            const responseId = btn.dataset.responseId ?? null;
            const type = btn.dataset.type ?? null;
            
            const box = btn.closest('.voteBox');
            const upvoteText = box.querySelector('.upvoteText');
            const downvoteText = box.querySelector('.downvoteText');

            


            try {
                const res = await fetch('/vote', {
                    url: '/vote',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        question_id: questionId,
                        response_id: responseId,
                        type: type,
                    }),
                });

                const data = await res.json();
                if(!data.error){
                    const upBtn = box.querySelector('[data-type="up"]');
                    const downBtn = box.querySelector('[data-type="down"]');

                    upBtn.classList.remove('text-blue-500','dark:text-yellow-500');
                    downBtn.classList.remove('text-blue-500','dark:text-yellow-500');

                    if(data.user_vote === 'up'){
                        upBtn.classList.add('text-blue-500','dark:text-yellow-500');
                    }

                    if(data.user_vote === 'down'){
                        downBtn.classList.add('text-blue-500','dark:text-yellow-500');
                    }
            
                    if(data.upvotes || data.downvotes){
                        upvoteText? upvoteText.innerText = data.upvotes : '';
                        downvoteText? downvoteText.innerText = data.downvotes : '';
                        initNotice('Voted Successful!', 'success');
                    }
                } else {
                    initNotice(data.error, 'error');
                }

            } catch(err) {
                initNotice('Voting Error!', 'error');
                console.error(err);
            }
        });
    });
}
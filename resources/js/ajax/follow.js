import { initNotice } from '../components/actionNotice.js';

export default function initFollow() {

    document.querySelectorAll('.followBtn').forEach(btn => {

        btn.addEventListener('click', async () => {

            const questionId = btn.dataset.questionId;
            const textEl = btn.querySelector('.followText');

            try {
                const res = await fetch('/question/follow', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        question_id: questionId
                    })
                });

                const data = await res.json();

                if (data.error) {
                    initNotice(data.error, 'error');
                    return;
                }

                if (data.status === 'followed') {
                    btn.dataset.followed = '1';
                    textEl.innerText = 'Unfollow';

                    btn.classList.add('text-blue-500', 'dark:text-yellow-500');

                    initNotice('Followed successfully', 'success');
                }

                if (data.status === 'unfollowed') {
                    btn.dataset.followed = '0';
                    textEl.innerText = 'Follow';

                    btn.classList.remove('text-blue-500', 'dark:text-yellow-500');

                    initNotice('Unfollowed', 'success');
                }

            } catch (err) {
                console.error(err);
                initNotice('Follow error', 'error');
            }

        });

    });
}
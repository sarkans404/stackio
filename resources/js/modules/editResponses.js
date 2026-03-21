export default function initEditResponses(){
     const editBtn = document.querySelectorAll('.edit-btn');
     const editForm = document.querySelectorAll('.edit-form');
     const editResetBtn = document.querySelectorAll('.edit-reset-btn');
     const responseBody = document.querySelectorAll('.response-body');
     const responseImage = document.querySelectorAll('.responseImage');

     editBtn.forEach((btn, index) => {
          btn.addEventListener('click', () => {
               if(editForm[index].classList.contains('hidden')){
                    editForm[index]?.classList.remove('hidden');
                    responseBody[index]?.classList.add('hidden');
                    responseImage[index]?.classList.add('hidden');
               } else {
                    editForm[index]?.classList.add('hidden');
                    responseBody[index]?.classList.remove('hidden');
                    responseImage[index]?.classList.remove('hidden');

               }
          });
     });

     editResetBtn.forEach((btn, index) => {
          btn.addEventListener('click', () => {
               if(!editForm[index].classList.contains('hidden')){
                    editForm[index]?.classList.add('hidden');
                    responseBody[index]?.classList.remove('hidden');
                    responseImage[index]?.classList.remove('hidden');
               }
          });
     });
}
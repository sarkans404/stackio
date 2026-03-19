export function initNotice(message){
     let notice = document.querySelector('#notice');
     
     let child = document.createElement('div');
     child.classList.add('flex', 'items-center', 'py-2', 'px-4', 'rounded', 'dark:bg-neutral-600', 'bg-gray-300');
     child.innerHTML += `<span class="text-medium">${message}</span>`;

     notice.appendChild(child);

     setTimeout(() => {
          notice.removeChild(child);
     }, 1300);
}
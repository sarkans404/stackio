export default function initGallery() {
    document.querySelectorAll('.galleryCont').forEach((gallery) => {

        const track = gallery.querySelectorAll('.imagesCont');
        const btnLeft = gallery.querySelector('.btnLeft');
        const btnRight = gallery.querySelector('.btnRight');
        const dots = gallery.querySelectorAll('.dots');
        const closeBtn = gallery.querySelector('.closeGallery');

        let index = 0;
        const total = track.length;

        function updateSlider() {
            track.forEach((el, i) => {
                el.style.transform = `translateX(-${index * 100}%)`;
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('opacity-50', i !== index);
            });
        }

        btnLeft?.addEventListener('click', (e) => {
            e.stopPropagation();
            index = (index - 1 + total) % total;
            updateSlider();
        });

        btnRight?.addEventListener('click', (e) => {
            e.stopPropagation();
            index = (index + 1) % total;
            updateSlider();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', (e) => {
                e.stopPropagation();
                index = i;
                updateSlider();
            });
        });


     gallery.addEventListener('click', () => {

          gallery.classList.add(
               'fixed',
               'inset-0',
               '-top-3',
               'z-50',
               'w-screen',
               'h-screen',
               'bg-black',
               'rounded-none'
          );

          gallery.classList.remove('h-140', 'relative');
          document.querySelector('.main-content').classList.remove('translate-x-20');
          document.body.classList.add('overflow-hidden');

          const tracks = gallery.querySelectorAll('.imagesCont');
          const images = gallery.querySelectorAll('.imagesCont img');

          tracks.forEach(el => {
               el.classList.add('flex', 'items-center', 'justify-center');
          });

          images.forEach(img => {
               img.classList.add('scale-125');
          });

          closeBtn?.classList.remove('hidden');
     });

     closeBtn?.addEventListener('click', (e) => {
          e.stopPropagation();

          gallery.classList.remove(
               'fixed',
               'inset-0',
               '-top-3',
               'z-50',
               'w-screen',
               'h-screen',
               'bg-black',
               'rounded-none'
          );

          gallery.classList.add('h-140', 'relative');

          document.body.classList.remove('overflow-hidden');
          if(document.querySelector('aside').classList.contains('-translate-x-[92%]')){
               document.querySelector('.main-content').classList.add('translate-x-20');
          }
          const tracks = gallery.querySelectorAll('.imagesCont');
          const images = gallery.querySelectorAll('.imagesCont img');

          tracks.forEach(el => {
               el.classList.remove('flex', 'items-center', 'justify-center');
          });

          images.forEach(img => {
               img.classList.remove('scale-125');
          });

          closeBtn.classList.add('hidden');
     });

        updateSlider();
    });


}
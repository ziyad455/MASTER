
let SliderDom = document.querySelectorAll('#carousel .list .item');
let thumbnailBorderDom = document.querySelector('#carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let carousel = document.getElementById('carousel');




let currentIndex = 0;


function updateCarousel(index) {
  // Reset all items
  SliderDom.forEach((item, i) => {
    item.style.zIndex = 0; 
    item.querySelector('.content').style.opacity = 0; 
    item.querySelector('img').style.filter = 'blur(20px)'; 
    item.querySelector('img').classList.remove('show-img');
    item.querySelector('.content').classList.remove('showContent');
  });

  // Activate the current item
  let currentItem = SliderDom[index];
  currentItem.style.zIndex = 100;
  currentItem.querySelector('img').classList.add('show-img');
  currentItem.querySelector('.content').classList.add('showContent');
  currentItem.querySelector('.content').style.opacity = 1;
  currentItem.querySelector('img').style.filter = 'blur(0px)';

  



  
  thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');


  thumbnailItemsDom.forEach((thumb, i) => {
    if (i === 0) {
      thumb.classList.add('effectNext');
      thumbnailBorderDom.appendChild(thumb);
      thumb.style.display = 'none';
    } else {
      thumb.classList.remove('effectNext');
      thumb.style.display = 'block'; 

    }
  });
}


next.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % SliderDom.length;
  updateCarousel(currentIndex);
});


thumbnailItemsDom.forEach((thumb, index) => {
  thumb.addEventListener('click', () => {
    currentIndex = index;
    updateCarousel(currentIndex);
  });
});


updateCarousel(currentIndex);

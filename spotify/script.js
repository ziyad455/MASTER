const images = document.querySelectorAll('.image');

images.forEach(im => {
  im.addEventListener('mouseenter',() => {
    images.forEach(image => {
      if(image !== im){
        image.classList.add('tr');
      }
    })
  })
})


images.forEach(im => {
  im.addEventListener('mouseleave',() => {
    images.forEach(image => {
        image.classList.remove('tr');
      
    })
  })
})

//part 2

document.addEventListener("DOMContentLoaded", function () {
  const menuBtn = document.getElementById("menu-btn");
  const navMenu = document.getElementById("nav-menu");

  menuBtn.addEventListener("click", function () {
    navMenu.classList.toggle("show");
  });
});




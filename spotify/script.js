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
  const icon = document.querySelector('#menu-btn i');

  menuBtn.addEventListener("click", function () {
    navMenu.classList.toggle("show");
    icon.classList.toggle('fa-close')
    icon.classList.toggle('fa-bars')
  });
});

window.addEventListener('click', function(e) {
  const navMenu = document.getElementById("nav-menu");
  const menuBtn = document.getElementById("menu-btn");
  const icon = document.querySelector('#menu-btn i');

  if (!navMenu.contains(e.target) && !menuBtn.contains(e.target)) {
      navMenu.classList.remove("show");
      icon.classList.toggle('fa-close')
      icon.classList.toggle('fa-bars')
      
  }
});


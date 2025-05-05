const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('menu');

toggle.addEventListener('click',() =>{
  menu.classList.toggle('show');
  toggle.querySelector('i').classList.toggle('fa-xmark');
  toggle.querySelector('i').classList.toggle('fa-bars');
})


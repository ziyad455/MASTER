const profile  = document.querySelector('.profil')
const menu = document.querySelector('.menu')
const to = document.querySelector('.to')
const left_bar = document.querySelector('.left-bar')
const right_bar = document.querySelector('.right-bar')
const div1 = document.querySelector('.div1')
const div2 = document.querySelector('.div2')
const conversation_item = document.querySelectorAll('.conversation-item')
const con1 = document.querySelectorAll('.con1 p');
const facebook_card = document.querySelector('.facebook-card')
const events = document.querySelectorAll('.events h5')
const event_cards = document.querySelectorAll('.event-cards')
const datebox = document.querySelectorAll('.date-box')
const dateboxbutton = document.querySelectorAll('.date-box button')
const textarea = document.querySelector('textarea')
const post = document.querySelectorAll('.post')
const contai = document.querySelector('.contai')
const profileprivacy = document.querySelectorAll('.profile-privacy')
const postp = document.querySelectorAll('.post p')
const l = document.querySelector('.contai button')


profile.addEventListener('click', (e) => {
  e.stopPropagation(); 
  menu.classList.toggle('show');
});


window.addEventListener('click', (e) => {

  if (!profile.contains(e.target) && !menu.contains(e.target)) {
    menu.classList.remove('show');
  }
});

to.addEventListener('click', () => {
  to.classList.toggle('fa-toggle-off');
  to.classList.toggle('fa-toggle-on');
  document.body.classList.toggle('darck');
  left_bar.classList.toggle('darck');
  right_bar.classList.toggle('darck');
  div1.classList.toggle('darck');
  div2.classList.toggle('darck');
  conversation_item.forEach(e => e.classList.toggle('darck'));
  menu.classList.toggle('darck');
  con1.forEach(e =>e.classList.toggle('darck'));
  facebook_card.classList.toggle('darck');
  events.forEach(e => e.classList.toggle('darck'));
  event_cards.forEach(e => e.classList.toggle('darck'));
  datebox.forEach(e => e.classList.toggle('darck'));
  dateboxbutton.forEach(e => e.classList.toggle('darck'));
  textarea.classList.toggle('darck');
  post.forEach(e => e.classList.toggle('darck'));
  contai.classList.toggle('darck');
  profileprivacy.forEach(e => e.classList.toggle('darck'));
  postp.forEach(e => e.classList.toggle('darck'));
  l.classList.toggle('darck');

})
const row = document.querySelector('.row');
const modal = document.getElementById('exampleModal');
const createBtn = document.querySelector('.create');

const modalTitleEl = document.getElementById('exampleModalLabel');
const modalBodyEl = document.getElementById('floatingInput');

let notes = [];

function create_note() {
  const title = modalTitleEl.value.trim();
  const body = modalBodyEl.value.trim();

  if (title === '' || body === '') {
    alert("Please fill in both the title and the note.");
    return;
  }

  const note = document.createElement('div');
  note.classList.add('col-md-6');
  note.innerHTML = `
    <div class="note">
      <h2>${title}</h2>
      <p class="content">${body}</p>
      <div class="note-actions">
        <button class="btn btn-primary edit-btn">Edit</button>
        <button class="btn btn-danger delete-btn">Delete</button>
      </div>
    </div>`;


  row.appendChild(note);

  // Save note data 
  notes.push({ title, body });
  save();

  // Add event listeners for Edit and Delete
  addNoteActions(note, title, body);

  //reset the modal contents
  modalTitleEl.value = 'modele title';
  modalBodyEl.value = '';
}


function addNoteActions(noteElement, title, body) {
  const editBtn = noteElement.querySelector('.edit-btn');
  const deleteBtn = noteElement.querySelector('.delete-btn');
  modalTitleEl.value = title;
  modalBodyEl.value = body;




  deleteBtn.addEventListener('click', () => {
    row.removeChild(noteElement);
    // Remove from notes array
    notes = notes.filter(n => !(n.title === title && n.body === body));
    save();
  });

  editBtn.addEventListener('click', () => {
    // Fill modal with existing note
    modalTitleEl.value = title;
    modalBodyEl.value = body;

    // Remove old note
    row.removeChild(noteElement);
    notes = notes.filter(n => !(n.title === title && n.body === body));
    save();

    //make medel show with editbtn
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
  });
}


// Load notes from localStorage
function load_notes() {
  const savedNotes = JSON.parse(localStorage.getItem('notes')) || [];
  notes = savedNotes;

  savedNotes.forEach(note => {
    const noteElement = document.createElement('div');
    noteElement.classList.add('col-md-6');
    noteElement.innerHTML = `
      <div class="note">
        <h2>${note.title}</h2>
        <p class="content">${note.body}</p>
        <div class="note-actions">
          <button class="btn btn-primary edit-btn">Edit</button>
          <button class="btn btn-danger delete-btn">Delete</button>
        </div>
      </div>`;

    row.appendChild(noteElement);
    addNoteActions(noteElement, note.title, note.body);
  });
}

// Save notes 
function save() {
  localStorage.setItem('notes', JSON.stringify(notes));
}


createBtn.addEventListener('click', create_note);

// Load existing notes before starting
load_notes();

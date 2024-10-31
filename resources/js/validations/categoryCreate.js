const icons = [ // !! dopo qualsiasi modifica cambiare anche nel controller
    'fa-solid fa-tablet-alt',
    'fa-solid fa-location-dot',
    'fa-solid fa-paperclip',
    'fa-solid fa-pen',
    'fa-brands fa-windows',
    'fa-solid fa-book',
    'fa-solid fa-print',
    'fa-regular fa-folder',
    'fa-solid fa-laptop',
    'fa-solid fa-cube',
    'fa-solid fa-puzzle-piece',
    'fa-solid fa-house',
];

const myForm = document.getElementById('myForm');
const nameEl = document.getElementById('name');
const error = document.querySelector('p.error');
myForm.addEventListener('submit',function(event){
    event.preventDefault();

    error.classList.remove("on");
    error.innerText = '';

    const selectedIcon = document.querySelector('input[name="icon"]:checked');
    let index = (selectedIcon.attributes.index.nodeValue);

    console.log(selectedIcon.value === icons[index])

    if(selectedIcon.value !== icons[index]){ // se non si e' cambiato il valore dell'icona
        if (!error.classList.contains('on')) {
            error.classList.add("on");
        }
        error.innerText = 'Errore generico, contatta l\'assistenza';
    } else if (nameEl.value == "") { // se non ha nome
        if (!error.classList.contains('on')) {
            error.classList.add("on");
        }
        error.innerText = 'Inserire il nome';
    }


})

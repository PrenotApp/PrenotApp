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

// Selezione degli elementi del form
const myForm = document.getElementById('myForm');
const nameEl = document.getElementById('name');
const error = document.querySelector('p.error');

// Aggiunta dell'evento "submit" al form
myForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Previene il comportamento di invio standard del form

    // Rimuove la classe di errore e resetta il messaggio
    error.classList.remove("on");
    error.innerText = '';

    // Seleziona l'icona scelta dall'utente
    const selectedIcon = document.querySelector('input[name="icon"]:checked');

    // Validazione: verifica che un'icona sia stata selezionata
    if (!selectedIcon) {
        showError('Seleziona un\'icona.');
        return;
    }

    // Recupera l'indice dell'icona selezionata
    const index = selectedIcon.attributes.index.nodeValue;

    // Controllo che l'icona selezionata corrisponda all'array "icons"
    if (selectedIcon.value !== icons[index]) {
        showError('Errore generico, contatta l\'assistenza');
        return;
    }

    // Validazione: verifica che sia stato inserito un nome
    if (nameEl.value.trim() === "") {
        showError('Inserire il nome');
        return;
    }

    // Se tutti i campi sono validi, invia il form
    myForm.submit();
});

// Funzione per mostrare gli errori in modo uniforme
function showError(message) {
    error.classList.add("on");
    error.innerText = message;
}


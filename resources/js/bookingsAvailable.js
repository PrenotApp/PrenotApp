document.addEventListener('DOMContentLoaded', function() {
    const itemId = document.querySelector('meta[name="item-id"]').content;
    const dateInput = document.getElementById('date');
    const hourSelect = document.getElementById('hour_id');
    const dateError = document.getElementById('dateError');

    // Funzione che invia la richiesta e aggiorna la select delle ore
    function loadAvailableHours() {
        const date = dateInput.value;

        // Verifica che i campi siano selezionati
        if (itemId && date) {
            // Fai una richiesta GET usando Axios
            axios.get('/prenotazioni/oredisponibili', {
                params: {
                    item_id: itemId,
                    date: date
                }
            })
            .then(function(response) {
                // Svuota la select delle ore
                hourSelect.innerHTML = '';

                if(response.data.length === 0) {
                    // logica per quando non ci sono orari disponibili
                    dateError.style.display = 'inline';
                    dateError.innerText = 'Non ci sono orari disponibili, prova a cambiare oggetto o data';
                } else {
                    dateError.style.display = 'none';
                    // Aggiungi le nuove opzioni delle ore disponibili
                    response.data.forEach(function(hour) {
                        const option = document.createElement('option');
                        option.value = hour.id;
                        option.textContent = (hour.name + ' ' + hour.start.slice(0, 5) + '-' + hour.end.slice(0, 5));
                        hourSelect.appendChild(option);
                    });
                }

                hourSelect.style.display = 'inline-block';
            })
            .catch(function(error) {
                console.error('Errore nella richiesta:', error);
            });
        }
    }

    // Ascolta i cambiamenti nei campi "item" e "date"
    dateInput.addEventListener('change', loadAvailableHours);
});

document.addEventListener('DOMContentLoaded', function() {
    const itemSelect = document.getElementById('item_id');
    const dateInput = document.getElementById('date');
    const hourSelect = document.getElementById('hour_id');
    const dateError = document.getElementById('dateError');

    // Funzione che invia la richiesta e aggiorna la select delle ore
    function loadAvailableHours() {
        const itemId = itemSelect.value;
        const date = dateInput.value;

        // Verifica che i campi siano selezionati
        if (itemId && date) {
            // Fai una richiesta GET usando Axios
            axios.get('/bookings/availablehours', {
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
                }

                hourSelect.style.display = 'inline-block';

                // Aggiungi le nuove opzioni delle ore disponibili
                response.data.forEach(function(hour) {
                    const option = document.createElement('option');
                    option.value = hour.id;
                    option.textContent = hour.name;
                    hourSelect.appendChild(option);
                });
            })
            .catch(function(error) {
                console.error('Errore nella richiesta:', error);
            });
        }
    }

    // Ascolta i cambiamenti nei campi "item" e "date"
    itemSelect.addEventListener('change', loadAvailableHours);
    dateInput.addEventListener('change', loadAvailableHours);
});

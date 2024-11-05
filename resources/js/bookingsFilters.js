document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Crea una query string
        const params = new URLSearchParams(new FormData(this)).toString();

        // Effettua la richiesta GET
        axios.get(`/prenotazioni/filtri?${params}`)
            .then(function (response) {
                document.getElementById('bookingsList').innerHTML = response.data.html; // Aggiorna la lista con i risultati filtrati
            })
            .catch(function (error) {
                console.error("Errore durante il filtro delle prenotazioni:", error); // Gestisci l'errore
            });
    });
});

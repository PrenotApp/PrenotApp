$(document).ready(function () {
    $('#filterForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('bookings.filter') }}", // Rotta per il filtro
            method: "GET",
            data: $(this).serialize(), // Invia i dati del form
            success: function (response) {
                $('#bookingsList').html(response); // Aggiorna la lista con i risultati filtrati
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const dateEl = document.getElementById('date');
    const hourEl = document.getElementById('hour_id');
    function loadItems(){
        const itemsEl = document.getElementById('availableItems');
        const rackId = document.getElementById('rack_id').value;

        if (dateEl.value != null && hourEl.value != null) {
            axios.get('/gruppi/disponibili', {
                params: {
                    date: dateEl.value,
                    hour_id: hourEl.value,
                    rack_id: rackId
                }
            })
            .then(function(response) {
                itemsEl.innerHTML = ''; // reset

                if (response.data.length == 0) {
                    let child = document.createElement('p');
                    child.textContent = 'Nessun oggetto disponibile in questo gruppo'
                    itemsEl.appendChild(option);
                } else {
                    response.data.forEach(function(item) {
                        let child = document.createElement('p');
                        child.value = item.id;
                        child.textContent = item.name;
                        itemsEl.appendChild(child);
                    });
                }

            });
        }
    }

    dateEl.addEventListener('change', loadItems);
    hourEl.addEventListener('change', loadItems);
});

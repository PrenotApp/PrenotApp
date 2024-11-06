document.addEventListener('DOMContentLoaded', function() {
    const dateEl = document.getElementById('date');
    const hourEl = document.getElementById('hour_id');
    function loadItems(){
        const itemsEl = document.getElementById('availableItems');
        const rackId = document.querySelector('meta[name="rack-id"]').content;
        const countItemsEl = document.getElementById('countItems');

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
                    countItemsEl.innerText = 0;
                } else {
                    response.data.forEach(function(item) {
                        let child = document.createElement('p');
                        child.value = item.id;
                        child.textContent = item.name;
                        itemsEl.appendChild(child);
                    });
                    countItemsEl.innerText = response.data.length
                }

            });
        }
    }

    dateEl.addEventListener('change', loadItems);
    hourEl.addEventListener('change', loadItems);
});

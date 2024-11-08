const myForm = document.getElementById('myForm');
myForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const dateEl = document.getElementById('date');
    const hourEl = document.getElementById('hour_id');
    if (dateEl.value != null && hourEl.value != "") {
        myForm.submit();
    }
})

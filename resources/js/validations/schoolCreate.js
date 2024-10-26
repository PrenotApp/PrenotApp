const myForm = document.getElementById('myForm');
myForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const nameEl = document.getElementById('name');
    if(nameEl.value.length > 0){
        console.log("ciao")
        myForm.submit();
    }
})


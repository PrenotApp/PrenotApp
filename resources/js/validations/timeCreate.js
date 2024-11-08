document.addEventListener('DOMContentLoaded', (event) => {
    const myForm = document.getElementById('myForm')
    myForm.addEventListener('submit', function(event) {
        event.preventDefault();

        updateErrors();

        let result = validate();  // Se non ci sono errori, invia il modulo
        if (result === true) {
            myForm.submit();
        }
    });
});

function validate() {
    const inputs = document.querySelectorAll('.error');// tutti gli errori

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].classList.contains('on')) { // se almeno un errore e' visualizzato,  falso
            return false;
        }
    }
    return true; // altrimenti vero
}

function updateErrors() {
    // # NAME
    const nameEl = document.getElementById('name');
    const nameErrorEl = document.getElementById('nameEr');
    function nameFunc (input, error) {
        const inpuitValue = input.value; // Prendi il valore dell'input
        if (inpuitValue.trim().length == 0) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Inserisci un nome";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    nameFunc(nameEl, nameErrorEl);
    nameEl.addEventListener('input', () => {
        nameFunc(nameEl, nameErrorEl);
    })

    // # TIME
    const startEl = document.getElementById('start');
    const endEl = document.getElementById('end');
    const errorEl = document.getElementById('timeEr');

    function timeFunc(startInput, endInput, error){
        let start =  startInput.value;
        let end =  endInput.value;
        if (start != "" && end != "") { // se start e end sono inseriti
            error.classList.remove('on'); // rimuovi errore
            error.innerText = '';
            function timeToMinutes(time) { // converte 02:12 in 132 minuti
                const [hours, minutes] = time.split(":").map(Number);
                return hours * 60 + minutes;
            }

            let startMinutes = timeToMinutes(start);
            let endMinutes = timeToMinutes(end);

            if(startMinutes >= endMinutes) { // se start e' dopo end
                error.classList.add('on'); // aggiungi errore
                error.innerText = 'L\'orario di fine deve essere successivo a quello d\'inizio';
            }
        } else { // altrimenti aggiungi classe on e errore
            error.classList.add('on'); // aggiungi errore
            error.innerText = 'Inserisci gli orari di inizio e fine';
        }
    }

    timeFunc(startEl, endEl, errorEl);
    startEl.addEventListener('input', () => {
        timeFunc(startEl, endEl, errorEl);
    });
    endEl.addEventListener('input', () => {
        timeFunc(startEl, endEl, errorEl);
    });
}

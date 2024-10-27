document.addEventListener('DOMContentLoaded', function() { // Quando la pagina e' caricata
    const formEl = document.getElementById('myForm');

    formEl.addEventListener('submit', function (event) { // Ascolta se c'e' un submit
        event.preventDefault(); // Non submittare

        updateInput(); // Controlla gli input

        let result = validate();  // Se non ci sono errori, invia il modulo
        if (result === true) {
            formEl.submit();
        }
    });
})

function validate() {
    const inputs = document.querySelectorAll('.error'); // tutti gli errori

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].classList.contains('on')) { // se almeno un errore e' visualizzato,  falso
            return false;
        }
    }
    return true; // altrimenti vero
}

function updateInput(){
    // # NAME
    const nameEl = document.getElementById('name'); // Prendi l'input el
    const nameErrorEl = document.querySelector('#name ~ .error'); // Prendi l'error el
    function nameFunc(element, error) {
        const elementValue = element.value; // Prendi il valore dell'input
        if (elementValue.trim().length < 3) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Inserisci un nome di almeno 3 lettere";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    nameFunc(nameEl, nameErrorEl); // Chiama subito la funzione per controllare
    nameEl.addEventListener('input', () => { // Chiamala ogni volta che viene updatato il valore
        nameFunc(nameEl, nameErrorEl)
    })

    // # EMAIL
    const emailEl = document.getElementById('email'); // Prendi l'input el
    const emailErrorEl = document.querySelector('#email ~ .error'); // Prendi l'error el
    function emailFunc(element, error) {
        function testEmail(email){
            // function to control if the email respect the pattern text@text.text
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        const elementValue = element.value; // Prendi il valore dell'input
        if (!testEmail(elementValue)) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Inserisci una mail valida";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    emailFunc(emailEl, emailErrorEl); // Chiama subito la funzione per controllare
    emailEl.addEventListener('input', () => { // Chiamala ogni volta che viene updatato il valore
        emailFunc(emailEl, emailErrorEl)
    })

    // # SCHOOL CODE
    const codeEl = document.getElementById('code'); // Prendi l'input el
    const codeErrorEl = document.querySelector('#code ~ .error'); // Prendi l'error el
    function codeFunc(element, error) {
        const elementValue = element.value; // Prendi il valore dell'input
        if (elementValue.length !== 8) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Inserisci un codice scuola valido";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    codeFunc(codeEl, codeErrorEl); // Chiama subito la funzione per controllare
    codeEl.addEventListener('input', () => { // Chiamala ogni volta che viene updatato il valore
        codeFunc(codeEl, codeErrorEl)
    })

    // # PASSWORD
    const passwordEl = document.getElementById('password'); // Prendi l'input el
    const passwordErrorEl = document.querySelector('#password ~ .error'); // Prendi l'error el
    function passwordFunc(element, error) {
        const elementValue = element.value; // Prendi il valore dell'input
        if (elementValue.length < 8) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Inserisci una password di almeno 8 lettere";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    passwordFunc(passwordEl, passwordErrorEl); // Chiama subito la funzione per controllare
    passwordEl.addEventListener('input', () => { // Chiamala ogni volta che viene updatato il valore
        passwordFunc(passwordEl, passwordErrorEl);
        pswConfirmFunc(pswConfirmEl, pswConfirmErrorEl)
    })

    // # PASSWORD CONFIRMATION
    const pswConfirmEl = document.getElementById('password-confirm'); // Prendi l'input el
    const pswConfirmErrorEl = document.querySelector('#password-confirm ~ .error'); // Prendi l'error el
    function pswConfirmFunc(element, error) {
        const elementValue = element.value; // Prendi il valore dell'input
        if (elementValue !== passwordEl.value) { // Definisici regola
            error.classList.add('on'); // Aggiungi errore
            error.innerText = "Le password devono essere uguali";
        } else {
            error.classList.remove('on'); // Togli errore
            error.innerText = "";
        }
    }

    pswConfirmFunc(pswConfirmEl, pswConfirmErrorEl); // Chiama subito la funzione per controllare
    pswConfirmEl.addEventListener('input', () => { // Chiamala ogni volta che viene updatato il valore
        pswConfirmFunc(pswConfirmEl, pswConfirmErrorEl)
    })
}

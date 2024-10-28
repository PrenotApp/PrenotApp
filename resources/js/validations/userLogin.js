const myForm = document.getElementById('myForm');
console.log("ciao")
myForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const emailEl = document.getElementById('email');
    const passwordEl = document.getElementById('password');
    if (emailEl.value != "" && passwordEl.value != "") {
        function testEmail(email){
            // function to control if the email respect the pattern text@text.text
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        if (testEmail(emailEl.value) == true){
            console.log(emailEl.value, testEmail(emailEl.value));
            myForm.submit();
        }
    }
})


function validateloginform() {
    var email = document.forms["loginform"]["email"].value;
    var password = document.forms["loginform"]["password"].value;

    if ((password === "") || (email === "")) {
        alert("all fields are compulsory");
        return false;
    }
}
function validatesignupform() {
    var name = document.forms["signupform"]["name"].value;
    var email = document.forms["signupform"]["email"].value;
    var password = document.forms["signupform"]["password"].value;

    if ((name === "") || (password === "") || (email === "")) {
        alert("all fields are compulsory");
        return false;
    }
}
function validateaskform() {
    var question = document.forms["askform"]["question"].value;

    if (question === "") {
        alert("please ask a question before submitting");
        return false;
    }
}
function validateanswerform() {
    var answerit = document.forms["answerform"]["answerit"].value;
    if (answerit === "") {
        alert("please answer the question before submitting");
        return false;
    }
}

function validateEmail(uemail)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (uemail.value.match(mailformat))
    {
        document.registration.desc.focus();
        return true;
    }
    else
    {
        alert("You have entered an invalid email address!");
//        uemail.focus();
        return false;
    }
}

function validatename(uname)
{
    var filter = /^[A-Za-z  /]+$/;
    if (uname.value.match(filter))
    {
// Focus goes to next field i.e. Address.
        document.registration.address.focus();
        return true;
    }
    else
    {
        alert('Alphabet characters only');
        uname.focus();
        return false;
    }
}

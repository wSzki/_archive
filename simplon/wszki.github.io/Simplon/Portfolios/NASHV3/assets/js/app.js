


document.addEventListener('DOMContentLoaded', function(e){
    let moon = document.getElementById('nightMode');
    moon.addEventListener('click', function(e){
        let body = document.getElementById('body');
        body.classList.toggle('bg-dark');
    })
});






const logUser = function(){
    var firstname =document.getElementById("firstname").value;
    var lastname =document.getElementById("lastname").value;
    var email =document.getElementById("email").value;
    var phone =document.getElementById("phone").value;
    var message =document.getElementById("message").value;

console.log(" " + firstname + " " + lastname + " " + email + " " + phone + " " + message )
}

document.addEventListener('DOMContentLoaded', function(e){
    console.log ('loaded')
    var button = document.getElementById('submit');

    button.addEventListener('click', function(){
        logUser()
    });
});

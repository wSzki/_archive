

/* const envoi = function () {
    let prenom = document.querySelector("#prenom").value;
    let nom = document.querySelector("#nom").value;

    alert("Bonjour " + prenom + " " + nom + ", nous avons bien reçu votre message.");

};

document.addEventListener("DOMContentLoaded", function (event) {

    console.log();

    const elem = document.querySelector(".logo");
    const submit = document.querySelector("submit");

    submit.addEventListener("click", function (event) {
        submit.classList.toggle("hidden");
    });

    console.log(elem);

    submit.addEventListener('click', function (e) {
        e.preventDefault();
        envoi();
    })

}); 


const envoi = function () {
    let prenom = document.querySelector("#prenom").value;
    let nom = document.querySelector("#nom").value;

    alert("Bonjour " + prenom + " " + nom + ", nous avons bien reçu votre message.");

};

document.addEventListener("DOMContentLoaded", function (event) {

    console.log();
*/





let menu = document.querySelector("#menuontheright");

let sideBar = "off";


document.addEventListener("click", (event) => {

    let camille = event.target.closest("#logo")

    if (camille == null) {
        menu.classList.add("hidden");
        menu.classList.remove("visible");
        sideBar = "off"
    }

    else if (camille.parentElement.id == "main-header") {

        if (sideBar == "off") {
            menu.classList.remove("hidden");
            menu.classList.add("visible");
            sideBar = "on";
        }

        else if (sideBar == "on") {            
            menu.classList.add("hidden");
            menu.classList.remove("visible");
            sideBar = "off";
        }
    }
}

)

/*


const elem = document.querySelector(".logo");
const menu = document.getElementById("menuontherightbis");

function funk(a) {
    console.log(a)

    var nodee = document.querySelector("#" + a)

    if (nodee.id == 'logo') {
        menu.classList.toggle("visible");
    }
    else {
        menu.classList.toggle("visible");
    }
}

console.log(menu);

/*});*/

/**/ 

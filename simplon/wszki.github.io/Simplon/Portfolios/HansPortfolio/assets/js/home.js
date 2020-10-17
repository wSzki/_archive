let link = document.querySelector("a");
link.href = "https://www.google.com/";


let menu = document.querySelector(".menu");
let bar = document.querySelector("header");

let sideBar = "off";



document.addEventListener("click", (event) => {

    
    let hans = event.target.closest("img, p")

    if(hans == null){
        bar.classList.add("left");
        bar.classList.remove("right");
        sideBar = "off"
    }
        
    else if (hans.parentElement.id == "menu") {

        if (sideBar == "off") {

            console.log("yo")
            bar.classList.add("right");
            bar.classList.remove("left");
            sideBar = "on";
        }

        else if (sideBar == "on") {
            bar.classList.add("left");
            bar.classList.remove("right");
            sideBar = "off";
        }
    }
}

)









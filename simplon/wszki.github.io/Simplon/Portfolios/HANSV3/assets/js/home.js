
let menu = document.querySelector(".menu");
let bar = document.querySelector(".roll");

const parallax = document.getElementsByClassName("para");
 
window.addEventListener("scroll",function(e){
    let offSet = window.pageYOffset;
    for(let i = 0;i<parallax.length;i++){     
         parallax[i].style.backgroundPositionY = offSet * 1.5;
        }  
})
console.log(window.onload);
isLoaded = false;

menu.addEventListener("click",function(){
    isLoaded = true;
   
    bar.classList.toggle("right");
    bar.classList.toggle("left");

})




let text = document.querySelector(".text");

let index = 0;

let texte = "Devellopeur web.";
function typing(){
    if(index<texte.length){
        text.innerHTML += texte.charAt(index++)
     setTimeout(typing,80)
    }
}
typing()



let photo = document.querySelector(".photo");
let tab = ["assets/img/css.jpg","assets/img/html.jpg"]
let i = 0;

function aplli(){
    photo.src = tab[i];

    if(i<tab.length -1){    
    
        i++
    }else {
        i = 0;
    }
    setTimeout(aplli,2000);
}


aplli();

let t = [7,8,9474.123,357878359,8475];

//tri d'un nombre le plus grand dans un tableau ;
function plusG (tableau){ 
      let maxTemp = 0;
    for (let i= 0;i<tableau.length;i++){
     
        if(maxTemp<tableau[i]){
         maxTemp = tableau[i];
        }
    }
   return maxTemp
}

console.log(plusG(t));
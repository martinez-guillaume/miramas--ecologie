//animation des articles page d'accueil avec l'id "container-section" lors du défilement de la page. 

var div1b =document.querySelector("#container-section");
// la variable pageHeight est définie pour stocker la hauteur totale de la page en utilisant document.body.scrollHeight.
       var pageHeight = document.body.scrollHeight;
       window.addEventListener('scroll', function(){
           // currentScroll est définie pour stocker la quantité de défilement actuelle en utilisant window.pageYOffset.
            var currentScroll = window.pageYOffset;
            var scrollpercent = (currentScroll / pageHeight) * 100;
            if (scrollpercent >= 26) {
                div1b.style.animation = "slide-in 2500ms";
                
            }
            else {
                div1b.style.animation = "none";
            
            }
        })      
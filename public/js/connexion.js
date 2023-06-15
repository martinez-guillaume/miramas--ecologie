//recapcha


// function onSubmit(token) {
//   document.getElementById("formi").submit();
// }




var form = document.querySelector('form');
//oeil pour voir password 

    var eyeShow = document.getElementById('eyeshow')
    eyeShow.style.display="none"
    var eyeHide = document.getElementById('eyehide')
    eyeHide.style.display="inline-block"


form['password'].addEventListener('keyup',function(){
    eyeHide.style.display="inline-block"

    eyeHide.addEventListener('click',()=>{
        form['password'].type = "text"
        eyeHide.style.display = "none"
        eyeShow.style.display = "inline-block"
    })
    eyeShow.addEventListener('click',()=>{
        form['password'].type = "password"
        eyeHide.style.display = "inline-block"
        eyeShow.style.display = "none"
    })



})
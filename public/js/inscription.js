const cara = document.getElementById('cara')
const maj = document.getElementById('maj')
const spec = document.getElementById('spec')
const num = document.getElementById('num')
const input1 =document.getElementById('password')
const pswConfirm = document.getElementById('passwordconfirm');


input1.addEventListener('keyup', passwordValidator)

//La fonction passwordValidator est définie pour valider le mot de passe

function passwordValidator(e) {
    e.preventDefault()
    let value = e.target.value;
    if (value.length > 8 && value.length < 36 ) {
        cara.className = "success-password"
        document.querySelector('button').disabled = false
    } else {
        cara.className = "span"
        document.querySelector('button').disabled = true
    }
    if (/[A-Z]/.test(value)) {
        maj.className = "success-password"
        document.querySelector('button').disabled = false
    } else {
        maj.className = "span"
        document.querySelector('button').disabled = true
    }
    if (/[0-9]/.test(value)) {
        num.className = "success-password"
        document.querySelector('button').disabled = false
    } else {
        num.className = "span"
        document.querySelector('button').disabled = true
    }
    if (/[!#$%^&*(),.?":{}|]/.test(value)) {
        spec.className = "success-password"
        document.querySelector('button').disabled = false
    } else {
        spec.className = "span"
        document.querySelector('button').disabled = true
    }
}

//input de confirmation du mot de passe pour vérifier si le mot de passe saisi correspond au mot de passe initial

pswConfirm.addEventListener('keyup', function() {
    let msgError = document.getElementById('red')
    if (input1.value !== pswConfirm.value) {
    pswConfirm.style.border = '2px solid red';
    pswConfirm.style.outline = 'none';
    msgError.style.display="block"
    document.querySelector('button').disabled = true;
} else {
    document.querySelector('button').disabled = false;
    pswConfirm.style.outline = 'none';
    pswConfirm.style.border = 'none';
    msgError.style.display='none';
}
});


var form = document.querySelector('form');
 
 
form.addEventListener('submit',function(e){
    // e.preventDefault()
    let username = form['username'].value
    let email = form['email'].value
    let psw = form['password'].value
    let pswConfirm = form['passwordconfirm'].value
  
})

//gestion de l'affichage des icônes des yeux pour afficher ou masquer les mots de passe.

    var eyeShow = document.getElementById('eyeshow')
    eyeShow.style.display="none"
    var eyeHide = document.getElementById('eyehide')
    eyeHide.style.display="none"
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


//Pour le champ de confirmation du mot de passe


var eyeShow2 = document.getElementById('eyeshow2')
eyeShow2.style.display="none"

var eyeHide2 = document.getElementById('eyehide2')
eyeHide2.style.display="none"

form['passwordconfirm'].addEventListener('keyup',function(){
eyeHide2.style.display="inline-block"

eyeHide2.addEventListener('click',()=>{
    form['passwordconfirm'].type = "text"
    eyeHide2.style.display = "none"
    eyeShow2.style.display = "inline-block"
})
eyeShow2.addEventListener('click',()=>{
    form['passwordconfirm'].type = "password"
    eyeHide2.style.display = "inline-block"
    eyeShow2.style.display = "none"
})



})






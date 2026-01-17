let inscrire = document.getElementById("inscrire")
let wrapperConnexion = document.querySelector('.wrapper-connexion')
let wrapperInscription = document.querySelector(".wrapper-inscription")
let connecter = document.querySelector(".connecter")
inscrire.addEventListener("click", function(e){
    e.preventDefault()
    wrapperConnexion.classList.add("d-none")
    wrapperInscription.classList.remove("d-none")
})

connecter.addEventListener("click", function(e){
    e.preventDefault()

     wrapperConnexion.classList.toggle("d-none")
    wrapperInscription.classList.toggle("d-none")
})
var ps = document.querySelectorAll('p')
for (var i = 0; i < ps.length; i ++) {
     var p = ps[i]

        p.addEventListener('mouseover', function (){
            this.classList.add('red')
        })
        p.addEventListener('mouseout', function (){
            this.classList.remove('red')
        })
}
var liens = document.querySelectorAll('a.external')
for(var i = 0; i < liens.length; i++) {
    var lien = liens[i]
    lien.addEventListener('click', function () {
       var reponse =  window.confirm('Voulez vous vraiment quitter le site')
       if(reponse === false) {
           event.preventDefault()
       }
    })
}

document.querySelector('#a').addEventListener('keydown', function (e){
    var lettre = String.fromCharCode(e.keyCode)
    if (lettre != "A" ) {
        e.preventDefault()
    }
    })


document.querySelector('#form').addEventListener('submit', function (e){
    var cp = document.querySelector('#cp')
    if(cp.value.length != 5){
        alert('Le code postal n\'est pas bon')
        e.preventDefault()
    }
})

document.querySelector('#form').addEventListener('submit', function (e){
    var mentions = document.querySelector('#mentions')
    if(mentions.checked === false ){
        alert('Je pete ma biere ,ma libullule')
        e.preventDefault()
    }
})
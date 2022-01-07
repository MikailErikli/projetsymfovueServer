/**
 * Lorsque je clique sur le boutton dans spoiler
 * j'ajoute la classe .visible a l'elemet suivant
 */
/**
var button = document.querySelector('.spoiler button')
button.addEventListener('click', function(){
    this.nextElementSibling.classList.add('visible')
    this.parentNode.removeChild(this)
})
 **/

var elements = document.querySelectorAll('.spoiler')

var createSpoilerButton = function (element) {

    // On crée la span
    var span = document.createElement('span')
    span.className = 'spoiler-content'
    span.innerHTML = element.innerHTML
    // On crée le bouton
    var button = document.createElement('button')
    button.textContent = 'Afficher le spoiler'

    // ON ajoute les élements
    element.innerHTML = ''
    element.appendChild(button)
    element.appendChild(span)

    button.addEventListener('click', function () {
        button.parentNode.removeChild(button)
        span.classList.add('visible')
    })
}

    for (var i = 0; i < elements.length; i++) {
        createSpoilerButton(elements[i])
    }



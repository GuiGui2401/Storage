<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gauge Loader</title>
  <style>
.progress-circle{
  position: relative;             /* pour servir de référent */
  box-sizing: border-box;         /* prise en compte bordure dans la dimension */
  font-size: 6em;                 /* pour définir les dimensions */
  width: 1.5em;                     /* fixe la largeur */
  height: 1.5em;                    /* fixe la hauteur */
  border-radius: 50%;             /* rendu aspect circulaire */
  border: .15em solid #CDE;       /* couleur de fond de l'anneau */
  background-color: #FFF;         /* couleur de fond de la progress bar */
}

.progress-masque {
  position: absolute;
  width: 1.5em;                     /* 100% de la largeur */
  height: 1.5em;                    /* 100% de la hauteur */
  left: -.155em;                   /* décalage de la largeur bordure de la gauge */
  top: -.155em;                    /* décalage de la largeur bordure de la gauge */
  clip: rect(0, 1.5em, 1.5em, .75em);  /* par défaut seule la partie droite est visible */
}

.progress-circle[data-value^='5']:not([data-value='5']):not([data-value^='5.']) .progress-masque,
.progress-circle[data-value^='6']:not([data-value='6']):not([data-value^='6.']) .progress-masque,
.progress-circle[data-value^='7']:not([data-value='7']):not([data-value^='7.']) .progress-masque,
.progress-circle[data-value^='8']:not([data-value='8']):not([data-value^='8.']) .progress-masque,
.progress-circle[data-value^='9']:not([data-value='9']):not([data-value^='9.']) .progress-masque,
.progress-circle[data-value^='100'] .progress-masque {
  clip: rect(auto, auto, auto, auto);
}

.progress-barre,
.progress-sup50 {
  position: absolute;
  box-sizing: border-box;         /* prise en compte bordure dans la dimension */
  border-width: .15em;            /* largeur bordure de la gauge */
  border-style: solid;
  border-color: #069;
  border-radius: 50%;             /* rendu aspect circulaire */
  width: 1.5em;                     /* largeur à 100% */
  height: 1.5em;                    /* hauteur à 100% */
  clip: rect(0, .75em, 1.5em, 0);    /* on ne garde que la partie gauche */
}

.progress-sup50 {
  display: none;
  clip: rect(0, 1.5em, 1.5em, .75em);
}

.progress-circle[data-value^='5']:not([data-value='5']):not([data-value^='5.']) .progress-sup50,
.progress-circle[data-value^='6']:not([data-value='6']):not([data-value^='6.']) .progress-sup50,
.progress-circle[data-value^='7']:not([data-value='7']):not([data-value^='7.']) .progress-sup50,
.progress-circle[data-value^='8']:not([data-value='8']):not([data-value^='8.']) .progress-sup50,
.progress-circle[data-value^='9']:not([data-value='9']):not([data-value^='9.']) .progress-sup50,
.progress-circle[data-value^='100'] .progress-sup50 {
  display:block;
}

.progress-circle:after {
  content: attr(data-value) "%";  /* récup. valeur de progression */
  font-size: 0.15em;              /* taille de la font en % du parent */
  height: 100%;                   /* centrage dans le parent */
  display: flex;
  align-items: center;
  justify-content: center;

  /*-- pour effet shadow intérieur --*/
  border-radius: 50%;
  box-shadow: 0 0 .5em rgba(0, 0, 0, .5) inset;
}
  </style>
</head>
<body>
  <div class="progress-circle" data-value="38"></div>
  <div class="progress-circle2" data-value="38"></div>


  <!-- JavaScript pour le cercle plein -->
  <script>
    function createJauge(elem) {
  if (elem) {
    // on commence par un clear
    while (elem.firstChild) {
      elem.removeChild(elem.firstChild);
    }
    // création des éléments
    var oMask  = document.createElement('DIV');
    var oBarre = document.createElement('DIV');
    var oSup50 = document.createElement('DIV');
    // affectation des classes
    oMask.className  = 'progress-masque';
    oBarre.className = 'progress-barre';
    oSup50.className = 'progress-sup50';
    // construction de l'arbre
    oMask.appendChild(oBarre);
    oMask.appendChild(oSup50);
    elem.appendChild(oMask);
  }
  return elem;
}

document.addEventListener('DOMContentLoaded', function() {
    var oJauges = document.querySelectorAll('.progress-circle');
    var i, nb = oJauges.length;
    for( i=0; i < nb; i +=1){
      createJauge(oJauges[i]);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var oJauges = document.querySelectorAll('.progress-circle2');
    var i, nb = oJauges.length;
    for( i=0; i < nb; i +=1){
      createJauge(oJauges[i]);
    }
});

  function initJauge(elem) {
  var oBarre;
  var angle;
  var valeur;
  //
  createJauge( elem);
  oBarre = elem.querySelector('.progress-barre');
  valeur = elem.getAttribute('data-value');
  valeur = 70; //valeur ? valeur * 1 : 0;
  elem.setAttribute('data-value', valeur.toFixed(1));
  angle = 360 * valeur / 100;
  if (oBarre) {
    oBarre.style.transform = 'rotate(' + angle + 'deg)';
  }
}

// Initialisation après chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
  var oJauges = document.querySelectorAll('.progress-circle');
  var i, nb = oJauges.length;
  for (i = 0; i < nb; i += 1) {
    initJauge(oJauges[i]);
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var oJauges = document.querySelectorAll('.progress-circle');
  var i, nb = oJauges.length;
  for (i = 0; i < nb; i += 1) {
    initJauge(oJauges[i]);
  }
});

  </script>
</body>
</html>

<html>
<head>
<title>Foutu test</title>
<style type="text/css">
.bubble-container {
  width: 150px;
  height: 150px;
  position: relative;
  border: 6px solid #00a2ff;
  border-radius: 50% 30% 50% 30%;
  padding: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bubble {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 6px solid #fff;
  position: relative;
  overflow: hidden;
  align-content: center;
}

.water-level {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 0%;
  background-color: #00a2ff;
  transition: height 0.5s ease-out;
  border-top-left-radius: 50%;
  border-top-right-radius: -50%;
}

.value {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 24px;
  font-weight: bold;
  color: #ccc;
}

.container {
  width: 400px;
  height: 200px;
  position: absolute;
  top: 30%;
  left: 50%;
  overflow: hidden;
  text-align: center;
  transform: translate(-50%, -50%);
}
.gauge-a {
  z-index: 1;
  position: absolute;
  background-color: rgba(255,255,255,.2);
  width: 400px;
  height: 200px;
  top: 0%;
  border-radius: 250px 250px 0px 0px;
}
.gauge-b {
  z-index: 3;
  position: absolute;
  background-color: #222;
  width: 250px;
  height: 125px;
  top: 75px;
  margin-left: 75px;
  margin-right: auto;
  border-radius: 250px 250px 0px 0px;
}
.gauge-c {
  z-index: 2;
  position: absolute;
  background-color: #5664F9;
  width: 400px;
  height: 200px;
  top: 200px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 0px 0px 200px 200px;
  transform-origin: center top;
  transition: all 1.3s ease-in-out;
}

.container:hover .gauge-data { color: rgba(255,255,255,1); }
.gauge-data {
  z-index: 4;
  color: rgba(255,255,255,.2);
  font-size: 1.5em;
  line-height: 25px;
  position: absolute;
  width: 400px;
  height: 200px;
  top: 90px;
  margin-left: auto;
  margin-right: auto;
  transition: all 1s ease-out;
}


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="bubble-container">
  <div class="bubble">
    <div class="water-level"></div>
    <div class="value"></div>
  </div>
</div>

<div class="container">
  <div class="gauge-a"></div>
  <div class="gauge-b"></div>
  <div class="gauge-c"></div>
  <div class="gauge-data">
    <h1 id="percent">0%</h1>
  </div>
</div>


<script type="text/javascript">
// Récupération de la div contenant le niveau d'eau
var waterLevel = document.querySelector('.water-level');

// Récupération de la div contenant la valeur reçue
var valueDiv = document.querySelector('.value');

// Connexion au serveur PHP et récupération des données
var xhr = new XMLHttpRequest();
xhr.open('GET', 'mon_script.php');
xhr.onload = function() {
  // Conversion des données en pourcentage de remplissage
  var fillPercentage = parseFloat(xhr.responseText) * 100;
  
  // Affichage de la valeur reçue
  var res = Math.round(xhr.responseText * 100)/100;
  valueDiv.textContent = res * 100;

  // Mise à jour du niveau d'eau avec une transition CSS
  waterLevel.style.height = (fillPercentage - 10) + '%';
};
xhr.send();

   fetch('get.php')
    .then(response => response.json())
    .then(data => {
      const value = data.value;
      // Calcul de la rotation de la jauge en fonction de la valeur
      const rotation = (value / 200) * 180;
      const gaugeC = document.querySelector('.gauge-c');
      gaugeC.style.transform = `rotate(${rotation}deg)`;
      // Mise à jour de la valeur affichée
      const percent = document.querySelector('#percent');
      percent.textContent = `${value}%`;
    })
    .catch(error => console.error(error));


</script>
</body>
</html>
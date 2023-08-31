/* globals Chart:false, feather:false */

function copyText() {
 
  var nickname = document.getElementById("nickname").innerHTML;
  var hostname = window.location.hostname;
  var protocol = window.location.protocol;
  let url = 'https://'+hostname+'/register/'+nickname;
  console.log(url);
  
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url);
    document.getElementById("copybutton").innerHTML = "Copiado!!!";
    setTimeout(() => {
      document.getElementById("copybutton").innerHTML = `Copiar mi enlace de invitación`;
    }, 1000);
  }
  else{
    // Alert the copied text
    alert("Requiere https para copiar");

  }

}


(function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' });


 
})()

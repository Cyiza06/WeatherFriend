var myInput1 = document.getElementById("psw1");
var eye2 = document.getElementById("eye2");
eye2.addEventListener('click', function name() {   
    if (myInput1.type === 'password') {
      myInput1.type = 'text'
      eye2.src = 'icons8_hide.ico'
    } else {
      myInput1.type = 'password'
      eye2.src = 'icons8_eye.ico'
    }
  });

  var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
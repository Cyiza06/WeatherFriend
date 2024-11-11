var myInput = document.getElementById("psw");
var eye1 = document.getElementById("eye1");



  eye1.addEventListener('click', function () {   
    if (myInput.type === 'password') {
      myInput.type = 'text';
      eye1.src = './img/icons8_hide.ico'
    } else {
      myInput.type = 'password'
      eye1.src = './img/icons8_eye.ico'
    }
  });
  
var myInput1 = document.querySelector(".psw");
var eye2 = document.querySelector(".eye1");


  function ghe() {   
    
    if (myInput1.type === 'password') {
      console.log('hbhj');
      myInput1.type = 'text';
      eye2.src = './img/icons8_hide.ico'
    } else {
      myInput1.type = 'password'
      eye2.src = './img/icons8_eye.ico'
    }
  }
 
var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}

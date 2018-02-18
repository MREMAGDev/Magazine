var arr_lock = false;
var eng_lock = false;

document.getElementById("eclass[]").disabled = false;
document.getElementById("engineer[]").disabled = false;
document.getElementById("arrangement[]").disabled = false;

document.getElementById("eclass[]").onchange = function() {
   document.getElementById("arrangement[]").disabled = this.value != '0'
   document.getElementById("engineer[]").disabled = this.value != '0'
}

document.getElementById("arrangement[]").onchange = function() {
   if(this.value != '0') { 
       arr_lock = true;
   } else {
       arr_lock = false;
   }
   if(eng_lock == false) {
       document.getElementById("eclass[]").disabled = this.value != '0'
   }
}

document.getElementById("engineer[]").onchange = function() {
   if(this.value != '0') { 
       eng_lock = true;
   } else {
       eng_lock = false;
   }
   if(arr_lock == false) {
       document.getElementById("eclass[]").disabled = this.value != '0'
   }
}


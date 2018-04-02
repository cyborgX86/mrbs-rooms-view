//Método 1 (Fade sin refresco php).
function showToday(){
  $('#hide').fadeOut();
  setTimeout(function(){$('#today').fadeIn()},500);
}
function showTomorrow(){
  $('#today').fadeOut();
  setTimeout(function(){$('#hide').fadeIn()},500);
}
var flag=false;
setInterval(function(){
  if(flag){
    showToday();
    flag=false;
  }else{
    showTomorrow();
    flag=true;
  }
}, 60000);

/*
//Método 2 (Con refresco php).
function loadToday(){
  $('#booking-table').load('index.php #today');
}
function loadTomorrow(){
  $('#booking-table').load('index.php #tomorrow');
}
var flag=false;
setInterval(function(){
  if(flag){
    loadToday();
    flag=false;
  }else{
    loadTomorrow();
    flag=true;
  }
}, 60000);
*/

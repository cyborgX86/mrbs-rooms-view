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
//Método 2 (Sin refresco php).
function alternate(){
  $('#today').toggle();
  $('#hide').toggle();
}
setInterval("alternate()", 60000);

//Método 3 (Con refresco php).
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

//método 4 (Uso delay con resfresco php).
function loadToday(){
  $('#booking-table').load('index.php #today');
}
function loadTomorrow(){
  $('#booking-table').load('index.php #tomorrow');
}
function delaytomorrow(){
  setTimeout("loadtomorrow()", 60000);
}
setTimeout("loadtomorrow()", 60000);
setInterval("loadtoday()", 120000);
setInterval("delaytomorroww()", 120000);

//Método 5 (En desarrollo Fade con refresco php).

function loadToday(){
  $('#hide').fadeOut();

  setTimeout(function(){
    $('#booking-table').fadeIn('slow', function {
      $('#today').load('index.php #today')
      }
    )},500);
}

function loadTomorrow(){
  $('#today').fadeOut('slow', function(){
      $('#tomorrow').load('index.php #tomorrow', function(){
          $('#booking-table').fadeIn('slow');
      });
  });

setTimeout(function(){
    $('#booking-table').fadeIn('slow', function {
      $('#tomorrow').load('index.php #tomorrow')
      }
    )},500);
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

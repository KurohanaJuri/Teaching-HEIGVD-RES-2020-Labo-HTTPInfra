// Set the date we're counting down to
var countDownDate = new Date("May 28, 2020 16:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor(distance / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  var milliseconds = Math.floor((distance % 1000) / 100);

  // Display the result in the element with id="demo"
  document.getElementById("clock").innerHTML = formatDeci(hours) + ":"
  + formatDeci(minutes) + ":" + formatDeci(seconds) + "." + milliseconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("clock").innerHTML = "EXPIRED";
  }
}, 100);

function formatDeci(num) {
  return (num < 10 ? "0" : "") + num;  
}

exports.setCounter = function(interval){
  setInterval(function(){

    document.getElementById("counter").innerHTML = interval-1;
  }, 1000)
}



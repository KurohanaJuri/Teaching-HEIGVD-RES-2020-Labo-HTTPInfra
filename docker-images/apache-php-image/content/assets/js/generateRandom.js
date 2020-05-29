$(function () {
  // Get the server ip
  function loadIp() {
    $.getJSON("/api/students/ip/", function (ip) {
      console.log(ip.eth0[0].address);

      $("#ipDynamic").text(ip.eth0[0].address);
    });
  }
  loadIp();

  console.log("Loading values");

  var interval = 30000;

  var currenTime;

  function loadRandomValues() {
    $.getJSON("/api/students/", function (valuesArray) {
      console.log(valuesArray);

      $("#randomValue").text(valuesArray.toString());
      $("#interval").text(interval / 1000);
    });
    currenTime = interval;
  }

  loadRandomValues();

  setInterval(function () {
    currenTime = currenTime - 1000;
    $("#counter").text(currenTime / 1000);
  }, 1000);
  setInterval(loadRandomValues, interval);
});

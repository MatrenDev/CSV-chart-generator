$(document).ready(function(){
  $.ajax({
    url: "http://localhost/_last/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var country = [];
      var num = [];

      for(var i in data) {
        country.push(data[i].country);
        num.push(data[i].num);
      }

      var chartdata = {
        labels: country,
        datasets : [
          {
            label: 'Obywatele',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: num
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
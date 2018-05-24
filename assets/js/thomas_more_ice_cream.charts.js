(function ($, drupalSettings) {
  $(document).ready(function () {
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(drupalSettings.chart_smaken
      );

      var options = {
        title: 'Smaken ijsjes',
        is3D: true
      };

      var chart = new google.visualization.PieChart(document.getElementById('ijs'));

      chart.draw(data, options);

      var data2 = google.visualization.arrayToDataTable(drupalSettings.chart_toppings
      );

      var options2 = {
        title: 'Toppings wafels',
        is3D: true
      };

      var chart2 = new google.visualization.PieChart(document.getElementById('wafel'));

      chart2.draw(data2, options2);
    }
  });

})(jQuery, drupalSettings);
KB.component('chart-project-time-comparison-by-column', function (containerElement, options) {

  this.render = function () {
    console.log(options.metrics);
      var metrics = options.metrics;
      var plotspent = ['spent'];
      var plotestimated = ['estimated'];
      var categories = {};

      for (var metric in metrics) {
        plotspent.push(metrics[metric].time_spent);
        plotestimated.push(metrics[metric].time_estimated);
      }

      KB.dom(containerElement).add(KB.dom('div').attr('id', 'chart').build());

      c3.generate({
          data: {
              columns: [plotspent,plotestimated],
              type: 'bar'
          },
          bar: {
              width: {
                  ratio: 0.5
              }
          },
          axis: {
              x: {
                  type: 'category',
                  categories: Object.keys(metrics)
              }
          },
          legend: {
              show: true
          }
      });
  };
});

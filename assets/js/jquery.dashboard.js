!function($) {
    "use strict";

    var Dashboard = function() {
    	this.$realData = []
    };

    //creates area chart with dotted
    Dashboard.prototype.createAreaChartDotted = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 0,
            lineWidth: 0,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            resize: true,
            gridLineColor: '#eef0f2',
            lineColors: lineColors,
            parseTime:false
        });

   },
    Dashboard.prototype.init = function() {

        var $array = $('#morris-area-with-dotted').data('played');
        $array = $array.split(',');
        var $arrayLast = $('#morris-area-with-dotted').data('last');
        $arrayLast = $arrayLast.split(',');

        var $areaDotData = new Array();
        for (var i = 0; i < $array.length; i++) {
            $areaDotData.push({ d: i.toString(), a: $array[i], b:$arrayLast[i]});
        }

        this.createAreaChartDotted('morris-area-with-dotted', 0, 0, $areaDotData, 'd', ['a', 'b'], ['This period', 'Previous period'],['#ffffff'],['#999999'], ['#36404a', '#5d9cec','#bbbbbb']);

    },
    //init
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Dashboard.init();
}(window.jQuery);

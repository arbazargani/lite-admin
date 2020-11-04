<style>
#receipts_chart_div {
    width: 100%;
    /* height: 150px; */
    direction: ltr
}

</style>
    
<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("receipts_chart_div", am4charts.PieChart);

// Add data
chart.data = [ {
    "Receipt": "Paid",
    "Count": {{ ($receipts_dataset['paid_receipts']*100)/$receipts_dataset['all_receipts'] }}
}, {
    "Receipt": "Unpaid",
    "Count": {{ ($receipts_dataset['unpaid_receipts']*100)/$receipts_dataset['all_receipts'] }}
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "Count";
pieSeries.dataFields.category = "Receipt";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="receipts_chart_div"></div>
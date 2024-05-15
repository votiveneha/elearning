@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


@section('content')
<div id="main">

      <section  class="topics section-bg pt-5">
      <div class="container">
   <div class="row">
    <div class="col-md-6">
<div class="user-st">
<h6><b> User Stats</b> </h6>
<p> Total Question</p>
<div class="chart-box">
  <div class="w-100">
<div class="d-flex justify-content-between align-content-center w-100">
  <div class="lablo"><label></label> <span>Solved</span>  </div>
  <p>72.56% </p>
</div>

<div class="d-flex justify-content-between align-content-center w-100">
  <div class="lablo"><label class="px-b"></label> <span>Unsolved</span>  </div>
  <p>29.34% </p>
</div>
</div>

<div class="cirle w-50">
  <section class="circle-chart p-0">
   <svg viewbox="0 0 35.83098862 35.83098862" width="120" height="120" xmlns="http://www.w3.org/2000/svg">
    <circle class="circle-chart__background" stroke="#DAD7FE" stroke-width="4" fill="none" cx="17.91549431" cy="17.91549431" r="15.91549431" />
    <circle class="circle-chart__circle" stroke="#8B84FE" stroke-width="4" stroke-dasharray="50,100" stroke-linecap="none" fill="none" cx="17.91549431" cy="17.91549431" r="15.91549431" />
    <g class="circle-chart__info">
      <text class="circle-chart__percent" x="16.91549431" y="16.5" alignment-baseline="central" text-anchor="middle" font-size="8">Total</text>
      <text class="circle-chart__subline" x="16.91549431" y="21.5" alignment-baseline="central" text-anchor="middle" font-size="3"> Questions</text>
    </g>
  </svg>
</section>
</div>
</div>
</div>
</div>

 <div class="col-md-6">
<div class="user-st">
<h6><b> Total Hours Spent</b> </h6>

<div class="chart-box" style="justify-content: center !important;">
<div class="cirle text-center">
 <div class="semi-donut margin" style="--percentage : 80; --fill: #FF9289 ; margin: auto;">
  <p>736<br>
<small>Total Hours</small></p>
</div>
   <p class="mt-3"> Long before you sit down to put the make sure you breathe</p>
</div>
</div>
</div>
</div>

<div class="col-md-12 mt-4">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Progress Score"
  },
  axisX:{
    valueFormatString: "DD MMM",
    crosshair: {
      enabled: true,
      snapToDataPoint: true
    }
  },
  axisY: {
    title: "",
    includeZero: true,
    crosshair: {
      enabled: true
    }
  },
  toolTip:{
    shared:true
  },  
  legend:{
    cursor:"pointer",
    verticalAlign: "bottom",
    horizontalAlign: "left",
    dockInsidePlotArea: true,
    itemclick: toogleDataSeries
  },
  data: [{
    type: "line",
    showInLegend: true,
    name: "",
    markerType: "square",
    xValueFormatString: "DD MMM, YYYY",
    color: "#F08080",
    dataPoints: [
      { x: new Date(2017, 0, 3), y: 650 },
      { x: new Date(2017, 0, 4), y: 700 },
      { x: new Date(2017, 0, 5), y: 710 },
      { x: new Date(2017, 0, 6), y: 658 },
      { x: new Date(2017, 0, 7), y: 734 },
      { x: new Date(2017, 0, 8), y: 963 },
      { x: new Date(2017, 0, 9), y: 847 },
      { x: new Date(2017, 0, 10), y: 853 },
      { x: new Date(2017, 0, 11), y: 869 },
      { x: new Date(2017, 0, 12), y: 943 },
      { x: new Date(2017, 0, 13), y: 970 },
      { x: new Date(2017, 0, 14), y: 869 },
      { x: new Date(2017, 0, 15), y: 890 },
      { x: new Date(2017, 0, 16), y: 930 }
    ]
  },
  {
    type: "line",
    showInLegend: true,
    name: "",
    lineDashType: "dash",
    dataPoints: [
      { x: new Date(2017, 0, 3), y: 510 },
      { x: new Date(2017, 0, 4), y: 560 },
      { x: new Date(2017, 0, 5), y: 540 },
      { x: new Date(2017, 0, 6), y: 558 },
      { x: new Date(2017, 0, 7), y: 544 },
      { x: new Date(2017, 0, 8), y: 693 },
      { x: new Date(2017, 0, 9), y: 657 },
      { x: new Date(2017, 0, 10), y: 663 },
      { x: new Date(2017, 0, 11), y: 639 },
      { x: new Date(2017, 0, 12), y: 673 },
      { x: new Date(2017, 0, 13), y: 660 },
      { x: new Date(2017, 0, 14), y: 562 },
      { x: new Date(2017, 0, 15), y: 643 },
      { x: new Date(2017, 0, 16), y: 570 }
    ]
  }]
});
chart.render();

function toogleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else{
    e.dataSeries.visible = true;
  }
  chart.render();
}

}
</script>

      <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</div>


</div>
   </div>

</section>







</div>
@endsection
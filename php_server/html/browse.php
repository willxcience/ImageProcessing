<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}

if(isset($_GET['query'])){
   $_SESSION['img_query'] = $_GET['query'];
   
}
else{
	unset($_SESSION['img_query']);
}
if(isset($_GET['project'])){
   $_SESSION['img_project'] = $_GET['project'];
}
else{
	unset($_SESSION['img_project']);
}


?>
<html>
<head>
    <meta charset="utf-8">
	
</head>
<style>

body {
  font-family: Univers, Arial, sans-serif;
}

.button rect {
  stroke: #999faa; /* navy 40% */
  stroke-width: 2px;
}

.button rect.pressed {
  fill: #000f2b; /* navy 100% */
}

.button #gradient-start {
  stop-color: #999faa; /* navy 40% */
  stop-opacity: 1;
}

.button #gradient-stop {
  stop-color: #4d576b; /* navy 70% */
  stop-opacity: 1;
}

.button #gradient-start.active, .button #gradient-start.pressed {
  stop-color: #4d576b; /* navy 70% */
}

.button #gradient-stop.active, .button #gradient-stop.pressed {
  stop-color: #000f2b; /* navy 100% */
}

.button text {
  font-size: 30px;
  fill: #eee;
  pointer-events: none;
  text-anchor: middle;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
}

</style>
<body> 
<select id="myoptions" onchange="doQuery(this.value)">

</select>

<select id="projs" onchange="doProject(this.value)">

</select>
  <script>
  var labelArray = {};
  var projectArray = {};
	// Populate menu for labels
  	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var got_path = 0;
	hr.onreadystatechange = function() 
	{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec2= hr.responseText;
		         labelArray = rec2.split("||");
			 console.log(rec2);
				got_path = 1;
			}
		var select = document.getElementById('myoptions');
		for(var i=1; i<labelArray.length; i++)
		{
			select.options[i] = new Option(labelArray[i], labelArray[i]);  //new Option("Text", "Value")
			//console.log(options[i]);
		}
	}
	hr.send("request=getlabel");
	// Populate menu for projects
  	var hr2 = new XMLHttpRequest();
	hr2.open("POST", "send.php", true);
	hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr2.onreadystatechange = function() 
	{
		if(hr2.readyState == 4 && hr2.status == 200) 
			{var rec2= hr2.responseText;
		         projectArray = rec2.split("||");
			 console.log(rec2);
			 console.log(projectArray);
				got_path = 1;
			}
		var select = document.getElementById('projs');
		for(var i=1; i<projectArray.length; i++)
		{
			select.options[i] = new Option(projectArray[i], projectArray[i]);  //new Option("Text", "Value")
			//console.log(options[i]);
		}
	}	
	hr2.send("request=getpro");


function doQuery(text){
	window.location.href = "browse.php"+"?query="+text;
}
function doProject(text){
	window.location.href = "browse.php"+"?project="+text;
}
</script>
<div id="pic"></div>
<p id="addtag"></p>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="d3.button.js"></script>
<script src="jquery-3.2.1.min.js"></script>
<script id="source" language="javascript" type="text/javascript">
	var w = window;
        var mapportion = 0.7;
        var mapwidth = 0.6;
        var cur_path= "/IMAGEDATA/test/";
        var current = 1;
        var pathArray ="";
	var labelArray ="";
	var ind_w=5.5;
	var ind_h=1;
	var ini_i=1;
	var data=[];
	var text1;
	var got_path = 0;
	function impath(){
	var hr = new XMLHttpRequest();
	hr.open("POST", "browse_send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
				got_path = 1;
		         pathArray = rec.split("||");
			console.log(rec);console.log(pathArray.length);
				
		imgs.enter()
		.append("svg:image")
		.attr("xlink:href", getim())
		.attr("x", "30")
		.attr("y", "30")
		.attr("width", "800")
		.attr("height", "450");
		console.log(pathArray[current]);
			}
			
		}
	 hr.send("request=getim");
	}
	impath();

	console.log("hello world");
	d3.select("body")
		.style("height", w.innerHeight + 'px')
		.style("width", w.innerWidth + 'px');

        d3.select("#pic")
            .style("position", "absolute")
            .style("top", "50px")
            .style("width", w.innerWidth + 'px')
            .style("height", w.innerHeight + 'px');
	var margin = { top: 20, right: 20, bottom: 20, left: 20 },
		width = w.innerWidth - margin.left - margin.right,
		height = w.innerHeight - margin.top - margin.bottom;
	var svg = d3.select("#pic").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		/*for(x in pathArray){
			console.log(x);
		}*/
				//while(!got_path);
		
var imgs = svg.selectAll("image").data([0]);
	/*var data = [{label: "Rabit",x: width / 10*5.5, y: height / 10*1 },
		    {label: "Deer", x: width / 10*5.5, y: height / 10*2 },
		    {label: "Nothing", x: width / 10*5.5, y: height / 10*3 }];*/
	var data2 = [{label: "<prev",x: width / 10*2, y: height / 10*6 },
		    {label: "next>", x: width / 10*3.2, y: height / 10*6 }];
	var data3 = [{label: "",x: width / 10*2, y: height / 10*7 }];
	var data4 = [{label: "download",x: width / 10*3.5, y: height / 10*7 }];

	 var button = d3.button()
	    .on('press', function(d, i) { console.log("Pressed label ", d.label); send(d.label);  change("next>");})
	 var button2 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed next/prev ", d.label); change(d.label);})
	 var button3 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed download ", d.label);})
	 var button4 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed remove labels ", d.label); 	console.log(getim());})

setTimeout(function(){ 
	while(!got_path);
	var buttons = svg.selectAll('.button')
	    .data(data)
	  .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button);

	var buttons2 = svg.selectAll('.button2')
	    .data(data2)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button2);
	var buttons3 = svg.selectAll('.button3')
	    .data(data3)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button3);
	var buttons4 = svg.selectAll('.button5')
	    .data(data4)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button4);
 	 text1=svg.append("text")
        .attr("x", width / 10*2.35)
        .attr("y", height / 10*5.78)
        .style("text-anchor", "start")
        .attr("dy", "0.7em")
        .style("font-weight", "bold")
	.style("font-size", "34px")
        .text(current+"/"+(pathArray.length-1));
		
	/* var temp=[{label: "sssss", x: width / 10*5.5, y: height / 10*6 }];	
	    svg.selectAll('.button4')
	    .data(temp)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button4);*/
console.log(pathArray)
 }, 100);
//console.log(getim());

function getim()
{
if(current> pathArray.length-1)
{current = pathArray.length-1;}
else if(current==0)
{current=1;}
var tem3=pathArray[current].split("/mnt/data/");
console.log(tem3[1]);
//return pathArray[current];
return tem3[1];
}
function change(x){
if(x=="next>"){ current+=1 }
else if(current>0) {current-=1}
		imgs.enter()
		.append("svg:image")
		.attr("xlink:href", getim())
		.attr("x", "30")
		.attr("y", "30")
		.attr("width", "800")
		.attr("height", "450");
text1.transition()
.text(current+"/"+(pathArray.length-1));
}
function send(label){
var hr = new XMLHttpRequest();
hr.open("POST", "browse_send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
console.log("!!!: label="+label+"&image=/mnt/data/"+getim());
 hr.send("label="+label+"&image=/mnt/data/"+getim());
}
//hr.send("rpp="+rpp+"&last="+last);
function query(){
	//console.log("sig");
	var person = prompt("Enter tag you wish to search for", "");
	if (person != null) {
	    var temp=[{label: person, x: width / 10*ind_w, y: height / 10*ind_h }];
	    getindex();
	    svg.selectAll('.button4')
	    .data(temp)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button);		
	}

	window.location.href = "browse.php"+"?query="+person;
 //hr.send("addlabel="+person+"&request=getim");
 //location.reload();
}

function getindex(){
if(ind_h==7)
{ind_w=6.8;ind_h=1;}
else{ind_h+=1;}
}

function download(img_path){

	var hr = new XMLHttpRequest();

	window.location.replace("/download_browse.php?filepath="+img_path);
	}
//addtag();

</script>
</body>

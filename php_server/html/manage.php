<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}
else if(!isset($_SESSION['admin'])){
   header("location:/");
   die;
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
  font-size: 40px;
  fill: #eee;
  pointer-events: none;
  text-anchor: middle;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
}

</style>
<body> 
<div id="pic"></div>
<p id="addtag"></p>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="d3.button.js"></script>
<script src="jquery-3.2.1.min.js"></script>
<script id="source" language="javascript" type="text/javascript">
	var w = window;
        var mapportion = 0.7;
        var mapwidth = 0.6;
	var ind_w = 1.5;
	var ind_h = 2;
	var ind_w2 = 6.5;
	var ind_h2 = 2.5;	
	var data = [];
	var data2 = [];
	var labelArray;
	var labelArray2={};
	var category;
	var current_file="";
	var buttons2;
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

	 var button = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); send(d.label);  })
	 var button2 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); download(d.label);  })


	var text1=svg.append("text")
        .attr("x", width / 10*1.35)
        .attr("y", height / 10*0.28)
        .style("text-anchor", "start")
        .attr("dy", "0.7em")
        .style("font-weight", "bold")
	.style("font-size", "34px")
        .text("select a project");

	var text2=svg.append("text")
        .attr("x", width / 10*5.35)
        .attr("y", height / 10*0.28)
        .style("text-anchor", "start")
        .attr("dy", "0.7em")
        .style("font-weight", "bold")
	.style("font-size", "34px")
        .text("select a category to download");

	function getproject(){
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
		          labelArray = rec.split("||");
			console.log(rec);console.log(labelArray.length);}
		for(var tem = 1; tem < labelArray.length;tem++)
		{
			data.push({label: labelArray[tem],x: width / 10*ind_w, y: height / 10*ind_h });
			getindex();
			//console.log(data)
		}
		}
	 hr.send("request=getpro");
	}
	getproject();
	setTimeout(function(){

	var buttons = svg.selectAll('.button')
	    .data(data)
	  .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button);
	},100);

	function send(project){
	//console.log( (svg.selectAll("svg"))["_parents"] );
	if(d3.selectAll("#test"))
	{d3.selectAll("#test").remove();}
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
			temp = rec.split("$$");
			temparray=temp[0].split("||");
			category=temp[1].split("||");
			//console.log(category);
			for(i = 1; i<category.length ;i++)
			{
				labelArray2[category[i]]=[];
			}
			key=Object.keys(labelArray2);
			data2 = [];
			ind_w2 = 6.5;
	 		ind_h2 = 2.5;//initialize
			for(i = 1; i<temparray.length ;i++)
			{
				temp2=temparray[i].split("--");
				if(key.indexOf(temp2[0])!=-1)
				{labelArray2[temp2[0]].push(temp2[1]);}
			}
			for(i = 1; i<category.length ;i++)
			{
				data2.push({label: category[i],x: width / 10*ind_w2, y: height / 10*ind_h2 });
				getindex2();
			}
			buttons2 = svg.selectAll('.button44')
			    .data(data2)
			    .enter()
			    .append('g')
			    .attr('class', 'button')
			    .call(button2);
			buttons2.attr("id", "test");
			current_file=project;
			console.log(rec);}
		}
	 hr.send("project="+project);
	}

	function download(label){

	var hr = new XMLHttpRequest();
	//hr.open("POST", "download_test.php", true);
	//hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//hr.send("filepath="+labelArray2[label]);
	window.location.replace("/download_test.php?filepath="+labelArray2[label]+"&label="+label);
	console.log("/download_test.php?filepath="+labelArray2[label]+"&label="+label);
	}

	function getindex(){
	if(ind_h==7)
	{ind_w=6.8;ind_h=1;}
	else{ind_h+=1;}
	}
	function getindex2(){
	if(ind_h2==7)
	{ind_w2=6.8;ind_h2=1;}
	else{ind_h2+=1;}
	}	

</script>
</body>

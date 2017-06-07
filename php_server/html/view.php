<html>
<head>
    <meta charset="utf-8">
</head>
<style>

#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}

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
  font-size: 200%;
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
        var cur_path= "/IMAGEDATA/test/";
        var current = 1;
        var pathArray ="";
	var labelArray ="";
	var ind_w=5.5;
	var ind_h=1;
	var got_path = 0;
	var ini_i=1;
	var data=[];
	var text1;
	function impath(){
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
		         pathArray = rec.split("||");
			console.log(rec);console.log(pathArray.length);}
		}
	 hr.send("request=getim");
	}
	impath();
	function label_ini(){
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec2= hr.responseText;
		         labelArray = rec2.split("||");
			 console.log(rec2);
			 	var imgs = svg.selectAll("image").data([0]);
				got_path = 1;
		imgs.enter()
		.append("svg:image")
		.attr("xlink:href", getim())
		.attr("x", "30")
		.attr("y", "30")
		.attr("width", width / 7*3)
		.attr("height", height / 7*3);
			for(var tem = 1; tem < labelArray.length;tem++)
				{
				data.push({label: labelArray[tem],x: width / 10*ind_w, y: height / 10*ind_h })
				getindex();
				//console.log(data)
				}
			}
		}
	 hr.send("request=getlabel");
	}
	label_ini();

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
	var imgs = svg.selectAll("image").data([0]);
	/*var data = [{label: "Rabit",x: width / 10*5.5, y: height / 10*1 },
		    {label: "Deer", x: width / 10*5.5, y: height / 10*2 },
		    {label: "Nothing", x: width / 10*5.5, y: height / 10*3 }];*/
	var data2 = [{label: "<prev",x: width / 10*2, y: height / 10*6 },
		    {label: "next>", x: width / 10*3.2, y: height / 10*6 },
 		    {label: "predict", x: width / 10*3.2, y: height / 10*8 },
		    {label: "original", x: width / 10*2.2, y: height / 10*8 }];
	var data3 = [{label: "add labels",x: width / 10*2, y: height / 10*7 }];
	var data4 = [{label: "remove labels",x: width / 10*3.5, y: height / 10*7 }];

	 var button = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); send(d.label);  change("next>");})
	 var button2 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); change(d.label);})
	 var button3 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); addtag();})
	 var button4 = d3.button()
	    .on('press', function(d, i) { console.log("Pressed", d.label); removetag();})

setTimeout(function(){ 
	while(!got_path);
	if(current > 1)
		current = 1;
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



	//var myElement = document.querySelector("#button");
	//console.log(myElement);
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
	else if(x=="<prev"&&current>0) {current-=1}
	else if(x=="predict"){
		move();
		var hr = new XMLHttpRequest();
		hr.open("POST", "send.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() 
			{
		
			if(hr.readyState == 4 && hr.status == 200) 
				{
				setTimeout(function(){ 
				
				var rec= hr.responseText;
				console.log(rec);
				if(rec=="ok")
				{setTimeout(imgs.enter()
				.append("svg:image")
				.attr("xlink:href", "/image/predictions.jpg")
				.attr("x", "30")
				.attr("y", "30")
				.attr("id", "imm")
				.attr("width", width / 7*3)
				.attr("height", height / 7*3),1000)
				}},100);}
			}
		 hr.send("predict="+pathArray[current]);
	}
if(x=="next>"||x=="<prev"||x=="original")
	{	
var elem = document.getElementById("myBar");  
		      elem.style.width = 0 + '%'; 
      			elem.innerHTML = 0 * 1  + '%';
		if(d3.selectAll("image"))
		{d3.selectAll("image").remove();}
		imgs.enter()
		.append("svg:image")
		.attr("xlink:href", getim())
		.attr("x", "30")
		.attr("y", "30")
		.attr("width", width / 7*3)
		.attr("height", height / 7*3);
		text1.transition()
		.text(current+"/"+(pathArray.length-1));
	}
}
function send(label){
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
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
function addtag(){
	//console.log("sig");
	var person = prompt("Pleas add tag", "");
	if (person != null) {
	    var temp=[{label: person, x: width / 10*ind_w, y: height / 10*ind_h }];
	    getindex();
	    svg.selectAll('.button4')
	    .data(temp)
	    .enter()
	    .append('g')
	    .attr('class', 'button')
	    .call(button);	
	    document.getElementById("addtag").innerHTML =
	    "tag "+person+" added";	
	}

var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
 hr.send("addlabel="+person);
}

function removetag(){
	console.log("removing")
	var remove_one = prompt("Pleas remove tag", "");
	if (remove_one != null) {
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
			console.log(rec);}
		}
	 hr.send("removelabel="+remove_one);
	}
	location.reload();
}

function getindex(){
if(ind_h==7)
{ind_w=6.8;ind_h=1;}
else{ind_h+=1;}
}
//addtag();

</script>

<div id="myProgress">
  <div id="myBar">0%</div>
</div>

<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 250);
  function frame() {
    if (width >= 100) {

      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}

</script>

</body>

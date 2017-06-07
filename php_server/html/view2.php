<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="./css/aa.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css" media="all" />
<head>
    <meta charset="utf-8">
    <div class="container-fluid" id="main_w">
        <div class="row">
            <div class="col-sm-5" style="background-color:#DFE2DB;height:800px" id="g0">

            </div>

            <div class="col-sm-4" style="background-color:#DFE1AB;height:800px">
                <div class="btn-group-lg" id="g1">
			<h4 class="text-center">Select a label</h4>
                </div>
            </div>

            <div class="col-sm-3" style="background-color:#DFE2DB;height:800px">
                <div class="btn-group-lg" id="g2">
			<h4 class="text-center">Select a project</h4>
                </div>
            </div>
        </div>
    </div>
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
<script src="/js/jquery-3.2.1.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="http://d3js.org/d3.v4.min.js"></script> 
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
	var projectArray=[];
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
		refresh_im();
		var th=$("<h4></h4>", {class:"text-center",text:current+"/"+(pathArray.length-1),id:"page_num_itm"});
		$(th).appendTo($('#g0'));

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
	setTimeout(function(){ label_ini();  }, 200);
	d3.select("body")
		.style("height", w.innerHeight + 'px')
		.style("width", w.innerWidth + 'px');

	var margin = { top: 20, right: 20, bottom: 20, left: 20 },
		width = w.innerWidth - margin.left - margin.right,
		height = w.innerHeight - margin.top - margin.bottom;
	var svg = d3.select("#g0").append("svg")
		.attr("width", w.innerWidth*5/12-20)
		.attr("height", w.innerHeight/7*3)
		.append("g")
		.attr("transform", "translate(" + 0 + "," + 0 + ")");
	var imgs = svg.selectAll("image").data([0]);
// < > button initialization
                var newid = $('#main_w button').length;
                var butt = $("<button></button>", {
                    id: "addr" + newid,
                    type: "button",
                    class: "btn btn-primary",
                    text: "<prev",
                    "data-id": newid
                });
                butt.on("click", function () {
                change($(this).text());
                });
        
		var butt2 =butt.clone();
                butt2.on("click", function () {
                change($(this).text());
                });
		butt2.text("next>");

		var butt3 =butt.clone();
                butt3.on("click", function () {
                addtag();
                });
		butt3.text("add label");

		var butt4 =butt.clone();
                butt4.on("click", function () {
                removetag();
                });
		butt4.text("remove label");

		var butt5 =butt.clone();
                butt5.on("click", function () {
                change($(this).text());
                });
		butt5.text("predict");

		butt.appendTo($('#g0'));
		butt2.appendTo($('#g0'));
		butt3.appendTo($('#g0'));
		butt4.appendTo($('#g0'));
		butt5.appendTo($('#g0'));
setTimeout(function(){ 
                var newid = $('#main_w button').length;
                var butt = $("<button></button>", {
                    id: "addr" + newid,
                    type: "button",
                    class: "btn btn-primary",
                    text: "",
                    "data-id": newid
                });
		var butt_array=[];
		console.log("data.length"+data.length);
		for (i=0;i<data.length-1;i++)
		{
		butt_array.push(butt.clone());
		console.log(data[i].label);
		butt_array[i].text(data[i].label);
                butt_array[i].on("click", function () {
                send($(this).text());  change("next>");
                });		
		butt_array[i].appendTo($('#g1'));
		}
 }, 200);
function getim()
{
if(current> pathArray.length-1)
{current = pathArray.length-1;}
else if(current==0)
{current=1;}
var tem3=pathArray[current].split("/mnt/data/");
console.log(tem3[1]);
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
				//console.log(rec);

				if(rec)
				{
console.log("/image/"+ rec + ".jpg");

setTimeout(imgs.enter()
				.append("svg:image")
				.attr("xlink:href", "/image/"+ rec + ".jpg")
				.attr("x", "0")
				.attr("y", "20")
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
		refresh_im();
		$('#page_num_itm').text(current+"/"+(pathArray.length-1));
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
function addtag(){
	var person = prompt("Pleas add tag", "");
	if (person != null) {
                var newid = $('#main_w button').length;
                var butt = $("<button></button>", {
                    id: "addr" + newid,
                    type: "button",
                    class: "btn btn-primary",
                    text: person,
                    "data-id": newid
                });
                butt.on("click", function () {
                send($(this).text());  change("next>");
                });
		butt.appendTo($('#g1'));
		
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
function refresh_im()
{
		imgs.enter()
		.append("svg:image")
		.attr("xlink:href", getim())
		.attr("x", "0")
		.attr("y", "20")
		.attr("width", width / 7*3)
		.attr("height", height / 7*3);
}
function getproject(){
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
	          projectArray = rec.split("||");
		projectArray[0]="all projects";
		console.log("pro: "+projectArray);console.log(projectArray.length);
		var butt_array=[];
		var newid = $('#main_w button').length;
                var butt = $("<button></button>", {
                    id: "addr" + newid,
                    type: "button",
                    class: "btn btn-primary",
                    "data-id": newid
                });
		for (i=0;i<projectArray.length-1;i++)
		{
		butt_array.push(butt.clone());
		butt_array[i].text(projectArray[i]);
                butt_array[i].on("click", function () {
                getproject_im($(this).text());
                });		
		butt_array[i].appendTo($('#g2'));
		}
		}
	}
 hr.send("request=getpro2");
}
function getproject_im(pro_name){
console.log("u cliked pro: "+pro_name);
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		pathArray = rec.split("||");
		current = 1;		
		change("<prev");
	        console.log("returned im:"+pathArray);  
		}
	}
 hr.send("getpro_im="+pro_name);
}
getproject();
</script>

</body>

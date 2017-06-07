<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}									
?>
<html lang="en">
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
</style>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/modal.css" media="all" />
<script src="/js/jquery-3.2.1.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="http://d3js.org/d3.v4.min.js"></script> 
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="jquery-3.2.1.min.js"></script>
<script src="black2.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
    <meta charset="utf-8">
    <div class="container-fluid" id="main_w">
        <div class="row">
            <div class="col-sm-6" style="background-color:#DFE2DB;height:900px" id="g0">
            	<a class="btn btn-success" href="index.php">home</a>
				<img class="img-thumbnail" id="only_one">
				<h3 class="text-center" id="only_text"></h3>
				<h3 class="text-center" id="label_text">no image</h3>
            </div>

            <div class="col-sm-3" style="background-color:#DFE1AB;height:900px">
				<h4 class="text-center">Select a label</h4>
                <div class="btn-group-lg" id="g1">
                </div>
            </div>

            <div class="col-sm-3" style="background-color:#DFE2DB;height:900px">
					<h4 class="text-center">Select a project</h4>
					<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="menu0" data-toggle="dropdown">select a level
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu0" id="mme0">

					  <nav class="navbar navbar-default">
						<div class="container-fluid">
						  <div id="nav_bar0">
							<ul class="nav navbar-nav" id="ini_nav0">
								<li><a href="#">-1~10</a></li>
								<li><a href="#">10~1000000</a></li>
								<li><a href="#">10~1000</a></li>
								<li><a href="#">1000~5000</a></li>
								<li><a href="#">5000~7500</a></li>
								<li><a href="#">7500~10000</a></li>
								<li><a href="#">10000~20000</a></li>
								<li><a href="#">20000~30000</a></li>
								<li><a href="#">30000~1000000</a></li>
								<li><a href="#">-1~1000000</a></li>
							</ul>
						  </div>
						</div>
					  </nav>

					</ul>
				  </div>
					
            </div>
        </div>
		
		<div id="myProgress">
		  <div id="myBar">0%</div>
		</div>

    </div>
</head>
<script>
</script>



<script>
//global variables
var cur_pro="all projects";
var cur_label="unlabelled";
var cur_loca;
var cur_time;
var cur_indice=0;
var score=["10","100000"];
var label_his=["unlabelled"];

//initialization project Array
getproject(1);
//initialization of all labels
all_labels2(0);
function label_ini()
{
    var butt = $("<button></button>", {
        type: "button",
        class: "btn btn-primary",
        text: "",
    });
	var butt_array=[];
	for (i=0;i<labelArray.length;i++)
	{
		butt_array.push(butt.clone());
		//console.log(labelArray[i]);
		butt_array[i].text(labelArray[i]);
	    butt_array[i].on("click", function () {label_his[cur_indice]=$(this).text(); send($(this).text());  change("next>");});		
		butt_array[i].appendTo($('#g1'));
		label_his.push("unlabelled");
	}
}
setTimeout(function()  //first time label initialization
{ 
	label_ini();
},400);

//image initialization
getproject_im2(cur_pro,"unlabelled","all locations",score,1);
function refresh_im()
{
	$("#only_one").attr('src',pathArray[cur_indice]);
	$("#only_text").text((cur_indice+1)+"/"+(pathArray.length));
	console.log(label_his);
	console.log(cur_indice);
	$("#label_text").text(label_his[cur_indice]);	
}
setTimeout(function()  //first time image initialization
{ 
	remove_path(pathArray);
	refresh_im();
	//console.log(pathArray);
},300);


//button functions
function change(x)
{
	console.log(x);
	if(x=="next>"&&cur_indice<pathArray.length-1){ cur_indice+=1; refresh_im(); }
	else if(x=="<prev"&&cur_indice>0) {cur_indice-=1; refresh_im();}
		
}

function addlabel()  //like it says, add a tag
{
	var new_label = prompt("Pleas add tag", "");
	if (new_label != null) 
		{
			var butt = $("<button></button>", {
			    type: "button",
			    class: "btn btn-primary btn-lg",
			    text: new_label,
			});
			butt.on("click", function () {send($(this).text());  change("next>"); });
			butt.appendTo($('#g1'));
			insert_label(new_label);
		}
}

function predict(){
move();
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log("predict retunr :"+rec);
		if(rec){$("#only_one").attr('src',"/image/"+ rec + ".jpg");}
		}
	}
 hr.send("predict="+"/mnt/data/"+pathArray[cur_indice]);
}

function send(label){ //update the label of image to database
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
 hr.send("label="+label+"&image=/mnt/data/"+pathArray[cur_indice]);
}

//button initialization
var butt = $("<button></button>", {
    type: "button",
    class: "btn btn-primary btn-lg",
    text: "<prev",
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
addlabel();
});
butt3.text("add label");

var butt5 =butt.clone();
butt5.on("click", function () {
predict();
});
butt5.text("predict");

butt.appendTo($('#g0'));
butt2.appendTo($('#g0'));
butt3.appendTo($('#g0'));
butt5.appendTo($('#g0'));


// clean current label
function clean_label()
{
	console.log("in clean");
	var ob = $("#g1")[0];
	while (ob.hasChildNodes()) {
	ob.removeChild(ob.firstChild);
	}
}

//initialization of remove a label
function remove_lb(text)//inside function
{
	var r = confirm("Are you sure to delete label: "+text);
	if (r == true) 
		{
			removetag(text);
			setTimeout(function(){
			all_labels2(0);
			},200);
			setTimeout(function(){
				console.log(labelArray)
				clean_label();
				label_ini();
			},300);
		}
}


var event_stop_1=[true,true,true,true,true,true];
setTimeout(function(){
make_one_e(1,"remove a label","",labelArray).appendTo($('#g0'));
add_on_e(1,event_stop_1,1,remove_lb,labelArray,false);	
},200);

//initialization of select a project
function select_pro(text,n)
{
    cur_pro=text;
   $("#menu"+n).text(text);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
   new_sapn.appendTo($("#menu"+n));
   getproject_im2(cur_pro,cur_label,"all locations",score,1);
   setTimeout(function(){
	   remove_path(pathArray);
	   cur_indice=0;
	   refresh_im();
   },200);	
      
}
setTimeout(function(){
make_one_e(2,"all projects","all projects",projectArray).appendTo($('#g0'));
add_on_e(2,event_stop_1,2,select_pro,projectArray,true);	

   setTimeout(function(){
   $("#head2").on("click", function () {
		cur_pro="all projects";
		select_pro(cur_pro,2)
		event_stop_1[2]=false;
		$("#menu2").text(cur_pro);
		var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
				    new_sapn.appendTo($("#menu2"));		
		});
   },200);
},200);

//initialization level menu
$("#ini_nav0").children('li').each(function(i) { 
    $(this).on("click", function () { 
    score=$(this).text().split("~");
    console.log(score);
    refresh();
    });
});

function refresh() //refresh im after porject 
{
   getproject_im2(cur_pro,cur_label,"all locations",score,1);
   setTimeout(function(){
	   remove_path(pathArray);
	   cur_indice=0;
	   refresh_im();
   },200);	
}


function move() { // move progess bar
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
//$.each($("#tab_logic tbody tr:nth(0) td"), function() {   });
//console.log($('#ini_nav0')[0].children);
</script>

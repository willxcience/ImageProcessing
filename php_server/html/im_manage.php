<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}									
?>

<html lang="en">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/modal.css" media="all" />
<link rel="stylesheet" type="text/css" href="./css/im_manage.css" media="all" />
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
        <div class="row" id="buttons">
            <div class="col-sm-3" style="background-color:#DFE2DB;height:200px" id="g0">
			<a class="btn btn-default" href="index.php">home</a>
				  <div class="dropdown">
					select a project
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">all projects
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="mme1">

					  <nav class="navbar navbar-default">
						<div class="container-fluid">
						  <div id="nav_bar1">
							<div class="navbar-header">
							  <a class="navbar-brand" href="#" id="head1">all projects</a>
							</div>
							<ul class="nav navbar-nav" id="ini_nav1">
							</ul>
						  </div>
						  <div id="selection-page1">
							<ul class="nav navbar-nav">
							</ul>
						  </div>
						</div>
					  </nav>

					</ul>
				  </div>
				  
				  <div class="dropdown">
					select a label
					<button class="btn btn-default dropdown-toggle" type="button" id="menu2" data-toggle="dropdown">all labels
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="mme2">

					  <nav class="navbar navbar-default">
						<div class="container-fluid">
						  <div id="nav_bar2">
							<div class="navbar-header">
							  <a class="navbar-brand" href="#" id="head2">all labels</a>
							</div>
							<ul class="nav navbar-nav" id="ini_nav2">
							</ul>
						  </div>
						  <div id="selection-page2">
							<ul class="nav navbar-nav">
							</ul>
						  </div>
						</div>
					  </nav>

					</ul>
				  </div> 
				  select a location
				  
            </div>

            <div class="col-sm-3" style="background-color:#DFE1AB;height:200px">

				<h4 class="text-center">options1</h4>
				<div class="radio">
				  <label>
					<input type="radio" id="add" name="underwear" required>
					add-on mode
					</input>
				  </label>
				   <label>
					<input type="radio" id="clean" name="underwear" checked="checked" required>
					auto-clean mode
					</input>
				  </label>
				</div>
					
				<button type="button" class="btn btn-success" id="process">Process</button>
				<button type="button" class="btn btn-warning" id="clean1">Clean</button>	 
				<button type="button" class="btn btn-danger" id="delete">Delete Checked Image</button>	
				<button type="button" class="btn btn-info" id="check_all">Check/Uncheck All Image</button>	
				<button type="button" class="btn btn-primary" id="download">Download All Checked Image</button>	     		

            </div>

            <div class="col-sm-3" style="background-color:#DFE2DB;height:200px">
                <div class="btn-group-lg" id="g3">
			<h4 class="text-center">options2</h4>
                </div>
            </div>
            <div class="col-sm-3" style="background-color:#DFE1AB;height:200px">

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
								<li><a href="#">10~1000</a></li>
								<li><a href="#">1000~5000</a></li>
								<li><a href="#">5000~7500</a></li>
								<li><a href="#">7500~10000</a></li>
								<li><a href="#">10000~20000</a></li>
								<li><a href="#">20000~30000</a></li>
								<li><a href="#">30000~1000000</a></li>
								<li><a href="#">10~1000000</a></li>
							</ul>
						  </div>
						</div>
					  </nav>

					</ul>
				  </div>

            </div>
        </div>
	<div class="row" id="all_images">
		<div class="row" id="row1">
		</div>
	</div>
			<div class="text-center">
				<ul class="pagination pagination-lg" id="page">
				</ul>
			</div>
	
	
    </div>
	<div id="myModal" class="modal">
	  <span class="close">&times;</span>
	  <img class="modal-content" id="img01">
	  <div id="caption"></div>
	</div>
</head>
<style>
</style>
<body>
<script id="source" language="javascript" type="text/javascript">
var cur_pro="all projects";
var cur_label="all labels";
var cur_loca="all locations";
var cur_time;
var cur_delete={};
var cur_radio="clean";
var score=["-1","100000"];
var imobArray=[];
var page_num=0;
var cur_page=1;
var check_all_b=0; //boolea for check all
event_stop_1=[true,true,true,true,true,true,true,true,true,true];
event_stop_2=[true,true,true,true,true,true];
// two head nav ini
$("#head1").on("click", function () {
	cur_pro="all projects";
    event_stop=false;
    $("#menu1").text(cur_pro);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
		        new_sapn.appendTo($("#menu1"));		
	});
$("#head2").on("click", function () {
	cur_label="all labels";
    event_stop2=false;
    $("#menu2").text(cur_label);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
		        new_sapn.appendTo($("#menu2"));		
	});
///inital A to Z object and add to nav_bar
getproject(0);
getlocation();
all_labels2(1);
all_labels();
setTimeout(function(){
sim_pro=[];
sim_label=[];    
for (i=0;i<projectArray.length;i++)
	{
	sim_pro.push(projectArray[i][0].toUpperCase());
	}  
sim_pro = sim_pro.reverse().filter(function (e, i, arr) {
	return arr.indexOf(e, i+1) === -1;
}).reverse();
console.log(sim_pro);
for (i=0;i<labelArray.length;i++){
	sim_label.push(labelArray[i][0].toUpperCase());
	}  
sim_label = sim_label.reverse().filter(function (e, i, arr) {
	return arr.indexOf(e, i+1) === -1;
}).reverse();
console.log(sim_label);	
for (i=0;i<sim_pro.length;i++)
	{
	var block = $("<li></li>", {});
	var block_info = $("<a></a>", { 'text': sim_pro[i],'href':"#" });
    block_info.appendTo(block);
    block.appendTo($("#ini_nav1"));
	}
for (i=0;i<sim_label.length;i++)
	{
	var block = $("<li></li>", {});
	var block_info = $("<a></a>", { 'text': sim_label[i],'href':"#" });
    block_info.appendTo(block);
    block.appendTo($("#ini_nav2"));
	}		


},200);
//project part

  var event_stop=true;
  setTimeout(function(){ 
	  $("#mme1").on("click", function (event) {
		if(event_stop)
		{event.stopPropagation();}
		else {event.originalEvent;event_stop=true;}
	  });
		var str = projectArray; 
	  var all_img = $("#nav_bar1")[0].getElementsByTagName("a");
	  for (i = 0; i < (all_img.length); i++) {
		all_img[i].onclick = function () {
		  var ob = $("#selection-page1")[0].children[0];
		  while (ob.hasChildNodes()) {
		    ob.removeChild(ob.firstChild);
		  }
		  var cur_ini = $(this).text();
		  for (j = 0; j < str.length; j++) {
		    var areEqual = cur_ini[0].toUpperCase() === str[j][0].toUpperCase();
		    if (areEqual) {
		      //console.log(str[j]);
		      var block = $("<li></li>", {class:"borderlist"});
		      var block_info = $("<a></a>", { 'text': str[j],'href':"#" });
		      block_info.on("click", function() { 
		        event_stop=false;
		        cur_pro=del_star($(this).text());
		        sp_label(cur_pro,1); 
		        setTimeout(function(){ sp(1,1);},300);
		        $("#menu1").text($(this).text());
		        var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
		        new_sapn.appendTo($("#menu1"));
		        });            
		      block_info.appendTo(block);
		      block.appendTo(ob);
		      sp(0,0);
		    }
		  }
		}
	  }
	  
	},200);
//label part
var event_stop2=true;
setTimeout(function(){ 
 $("#mme2").on("click", function (event) {
		if(event_stop2)
		{event.stopPropagation();}
		else {event.originalEvent;event_stop2=true;}
	  });
		var str = labelArray; 
	  var all_img = $("#nav_bar2")[0].getElementsByTagName("a");
	  for (i = 0; i < (all_img.length); i++) {
		all_img[i].onclick = function () {
		  var ob = $("#selection-page2")[0].children[0];
		  while (ob.hasChildNodes()) {
		    ob.removeChild(ob.firstChild);
		  }
		  var cur_ini = $(this).text();
		  for (j = 0; j < str.length; j++) {
		    var areEqual = cur_ini[0].toUpperCase() === str[j][0].toUpperCase();
		    if (areEqual) {
		      //console.log(str[j]);
		      var block = $("<li></li>", {class:"borderlist"});
		      var block_info = $("<a></a>", { 'text': str[j],'href':"#" });
		      block_info.on("click", function() { 
		        event_stop2=false;
		        cur_label=del_star($(this).text());
		        sp_project(cur_label,1);
		        setTimeout(function(){ sp(0,1);},300);
		        console.log("cur label: "+cur_label);
		        $("#menu2").text($(this).text());
		        var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
		        new_sapn.appendTo($("#menu2"));
		        });            
		      block_info.appendTo(block);
		      block.appendTo(ob);
		      sp(1,0);
		    }
		  }
		}
	  }
	},200);

//relabel button
function re_label(text)
{
 	var r = confirm("Are you sure to re-label checked images to project:  "+text);
    if (r == true) 
    	{
			for(i=0;i<pathArray.length;i++)
			{
				if(cur_delete[pathArray[i]]==1)
				{
					console.log(pathArray[i]);
					send_2(text,pathArray[i]);
					setTimeout(function(){ clean(); process();},300);					
				}
			}
    	}
}
setTimeout(function(){
make_one_e(4,"Label Checked image To","",labelArray2).appendTo($('#g3'));
add_on_e(4,event_stop_2,4,re_label,labelArray2,false);	
},220);



//move img button
function move_im(text)
{
 	var r = confirm("Are you sure to move checked images to project: "+text);
    if (r == true) 
    	{
			for(i=0;i<pathArray.length;i++)
			{
				if(cur_delete[pathArray[i]]==1)
				{
					move_img(pathArray[i],text);
					setTimeout(function(){ clean(); process();},300);					
				}
			}
    	}
}
setTimeout(function(){
make_one_e(3,"Move Checked Image To","",projectArray).appendTo($('#g3'));
add_on_e(3,event_stop_1,3,move_im,projectArray,false);	
},200);

//relocate button
function reloca_im(text)
{
 	var r = confirm("Are you sure to change checked images' location as "+text);
    if (r == true) 
    	{
			for(i=0;i<pathArray.length;i++)
			{
				if(cur_delete[pathArray[i]]==1)
				{
					send_3(text,pathArray[i]);
					setTimeout(function(){ clean(); process();},300);				
				}
			}
    	}
}
setTimeout(function(){
make_one_e(6,"Relabel Checked Image Locations To","",locaArray).appendTo($('#g3'));
add_on_e(6,event_stop_1,6,reloca_im,locaArray,false);	
},300);

//location button
function set_loca(text)
{
	cur_loca=text;
   $('#menu5').text(text);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
	new_sapn.appendTo($("#menu5"));
}
setTimeout(function(){
make_one_e(5,"all locations","all locations",locaArray).appendTo($('#g0'));
add_on_e(5,event_stop_1,5,set_loca,locaArray,false);	

$("#head5").on("click", function () {
	cur_loca="all locations";
    event_stop_1[5]=false;  // this doest work
    $("#menu5").text(cur_loca);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
	new_sapn.appendTo($("#menu5"));		
	});

},200);


	
//process button
function process()
{
var oldArray = pathArray.slice();
getproject_im2(cur_pro,cur_label,cur_loca,score,0);
//console.log(pathArray);
  setTimeout(function(){ 
  	if(cur_radio=="clean")
  	{clean();}
  	remove_path(pathArray);
	if(cur_radio!="clean")
	{pathArray=pathArray.concat(oldArray);}
	for(i=0;i<pathArray.length;i++)
	{
		var div_ob= $("<div></div>", {class: "col-sm-2",id:"col"+i});
		var img_ob= $("<img></img>", {src:pathArray[i],class: "img-thumbnail my_im",alt:"test_im"});	
		var label_ob=  $("<label></label>", {class:"btn btn-danger btn-xs btn_my"});
		var box_ob=  $("<input></input>", {type:"checkbox",autocomplete:"off",id:pathArray[i]});
		img_ob.appendTo(div_ob);
		box_ob.appendTo(label_ob);
		label_ob.appendTo(div_ob);
		//div_ob.appendTo($("#row1"));
		imobArray.push(div_ob);
		cur_delete[pathArray[i]]=0;	
		img_ob[0].onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}
	}
	page_ini();
	add_check();
	
	},300);
}
$("#process").on("click", function () {process();});

//pagination function
function page_ini(){
cur_page=1;
page_size=24;
page_num=Math.ceil(imobArray.length/24);
//for(i=0;(i<24&&i<imobArray.length);i++)
for(i=(0+(cur_page-1)*24);(i<(24*cur_page)&&i<imobArray.length);i++)
{imobArray[i].appendTo($("#row1"));}
for(i=1;i<=page_num;i++)
	{	console.log( $('#p_'+i).length);
		if ($('#p_'+i).length == 0)
		{
			var ob1 =$("<li></li>",{id:"p_"+i});
			var ob2 =$("<a></a>",{href:"#",text:i});
			ob2.appendTo(ob1);
			ob1.appendTo("#page");
			ob1.on("click", function () { fresh_page(($(this)[0].id).split("p_")[1]) });
		}  

	}
}

function fresh_page(p){
cur_page=parseInt(p);
for(i=1;i<=page_num;i++)
	{
		$('#p_'+i).attr('class', '');
	}
$('#p_'+p).attr('class', 'active');

var ob = $("#row1")[0];
while (ob.hasChildNodes()) {
ob.removeChild(ob.firstChild);
}

for(i=(0+(cur_page-1)*24);(i<(24*cur_page)&&i<imobArray.length);i++)
{imobArray[i].appendTo($("#row1"));}
add_check();
}
//clean button
function clean(){
	imobArray=[];
	  var ob = $("#row1")[0];
	  while (ob.hasChildNodes()) {
	    ob.removeChild(ob.firstChild);
	  }
	  var ob2 = $("#page")[0];
	  while (ob2.hasChildNodes()) {
	    ob2.removeChild(ob2.firstChild);
	  }	  
}
$("#clean1").on("click", function(){clean();});
//delete button
$("#delete").on("click", function () {
	for(i=0;i<pathArray.length;i++)
	{
		if(cur_delete[pathArray[i]]==1)
		{
			delete_im(pathArray[i]);
		}
	}
	clean();
	setTimeout(function(){ process();},300);	
});

//check all button
$( "#check_all" ).on( "click", function (){  
  //console.log( (imobArray[0][0].children[1]).children[0]  );
  //var cbs = document.getElementsByTagName('input');
  cbs=[];
  for(i=0;i<imobArray.length;i++)
  {
  	cbs.push( (imobArray[i][0].children[1]).children[0] );
  }
  for(i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
		if(check_all_b==1) 
		{
			cbs[i].checked = false;
			for(z=0;z<pathArray.length;z++)
			{
				cur_delete[pathArray[z]]=0;
			}
		}
		else if(check_all_b==0) 
		{
			cbs[i].checked = true;
			for(z=0;z<pathArray.length;z++)
			{
				cur_delete[pathArray[z]]=1;
			}			
		}
    }
  }
  if(check_all_b==1) {check_all_b=0;}
  else if(check_all_b==0) {check_all_b=1;}
  //console.log(cur_delete);
  
 });
 
 //download button
$( "#download" ).on( "click", function (){ 
str="||";
tem_path=add_path(pathArray);
for(z=0;z<tem_path.length;z++)
{
	if(cur_delete[pathArray[z]]==1)
	{	str=str+tem_path[z]+"||";}
}
download_checked(str); 
});
 
 
//radio
$( "input[type=radio]" ).on( "click",  
	function () { cur_radio=($(this)[0].id); }
);
// level selction
$("#ini_nav0").children('li').each(function(i) { 
    $(this).on("click", function () { 
    str=$(this).text();
    score=$(this).text().split("~");
    console.log(score);
    $('#menu0').text(str);
    var new_sapn= $("<span></span>", {class: "caret",id:"ss"});
	new_sapn.appendTo($("#menu0"));
    });
});


// add check box to current page
function add_check()
{
	//check box
	$('label > input[type=checkbox]').on('change', function () {
		temp=$(this)[0].id;
		console.log('checked:'+temp);
		if(cur_delete[temp]==0)//checked
		{
			cur_delete[temp]=1;
		}
		else if(cur_delete[temp]==1)//unchecked
		{
			cur_delete[temp]=0;
		}
	})
}

//
function sp(res_n,head) //0 for pro, 1 for label,2 for loca
{   var res=[];
	var n=-1;
	if(res_n==0)
	{
		res=res0;
		n=1;
	}	
	if(res_n==1)
	{
		res=res1;
		n=2;
	}
	if(head==1)
	{
		s_res=simple(res);
		ob=$('#ini_nav'+n);
		list=ob.find("a");
		$.each(list,function( index, value ) {
		value.innerText=del_star(value.innerText);
		if(s_res.includes(value.innerText))
			{
				value.innerText=value.innerText+"*";
			}
		});		
	}
	if(head==0)
	{
		s_res=res;
		console.log(s_res);
		ob=$('#selection-page'+n);
		list=ob.find("a");
		$.each(list,function( index, value ) {
		value.innerText=del_star(value.innerText);
		if(s_res.includes(value.innerText))
			{
				value.innerText=value.innerText+"*";
			}
		});	
	}
}
//setTimeout(function(){ clean_2();},300);

function simple(theArray) //get simplified array
{
	sim_label=[];    
	for (i=0;i<theArray.length;i++)
		{
			//console.log("reach here");
			sim_label.push(theArray[i][0].toUpperCase());
		}  
	sim_label = sim_label.reverse().filter(function (e, i, arr) {return arr.indexOf(e, i+1) === -1;}).reverse();
	return sim_label;	
}

function del_star(text)  //getrid of star
{
	tem=text.split("*");
	return tem[0];
}
//imge modal 

var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
    modal.style.display = "none";
}


setTimeout(function(){ console.log(projectArray); },300);
	
</script>

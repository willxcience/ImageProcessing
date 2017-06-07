var projectArray=[]; //array contain all project
var pathArray=[];  // array contain impath of current project
var labelArray=[];
var locaArray=[];
var labelArray2=[];
var res0=[]; //special poject
var res1=[]; //special label
var res2=[]; //special location

console.log("wtfzzaa");
function getproject(for_label){  //get all projects
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
	        projectArray = rec.split("||");
	        projectArray.shift();
	        console.log("dameosso");
		}
	}
if(for_label)  //for labelling page or not
{hr.send("request=getpro2");}
else{hr.send("request=getpro");}
}

function getlocation(){ // get all location
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
	        locaArray = rec.split("||");
	        locaArray.shift();
		}
	}
hr.send("request=getloca")
}


function getproject_im2(pro_name,label_name,loca_name,score,for_label){ //get all image given a label and a project
//console.log("pass");
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		pathArray = rec.split("||"); 
		pathArray.shift();
		//console.log(rec);
		}
	}
if(for_label)
{hr.send("p_name="+pro_name+"&l_name="+label_name+"&upper="+score[1]+"&lower="+score[0]+"&loca="+loca_name+"&process=yes");}
else {hr.send("p_name="+pro_name+"&l_name="+label_name+"&upper="+score[1]+"&lower="+score[0]+"&loca="+loca_name+"&process=no_need");}

}

function all_labels(){ //get all used labels for image
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		labelArray = rec.split("||");
		labelArray.shift();
		}
	}
 hr.send("request=get_all_label");
}

function all_labels2(extra){ //get all used or unused labels
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		if(extra)
			{
				labelArray2 = rec.split("||");
				labelArray2.shift();
			}
		else
			{
				labelArray = rec.split("||");
				labelArray.shift();
			}	
		}
	}
 hr.send("request=getlabel");
}


function delete_im(ob){ //remove image from data set
var hr = new XMLHttpRequest();
console.log("delete: "+ob);
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);
		}
	}
 hr.send("delete="+"/mnt/data/"+ob);
}

function get_unlabelled(pro_name){ //get unlabelled project image
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

function removetag(remove_one){  //remove tag 
	console.log("rr:"+remove_one);
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

function move_img(img,dest){  //move image from one project to another
	console.log("move "+img+" to "+dest);
	var hr = new XMLHttpRequest();
	hr.open("POST", "send.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
		{
		if(hr.readyState == 4 && hr.status == 200) 
			{var rec= hr.responseText;
			console.log(rec);}
		}
	 hr.send("move_im="+"/mnt/data/"+img+"&dest="+dest);
}


function send_2(label,img){ //update the label of image to database
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
 hr.send("label="+label+"&image=/mnt/data/"+img);
}

function send_3(label,img){ //update the location of image to database
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
 hr.send("loca="+label+"&image=/mnt/data/"+img);
}

function insert_label(label){ //inset new label to dataset
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);}
	}
 hr.send("addlabel="+label);
}

function sp_label(name,type) //get special label after click project or location --- type 1 = project type 2 = location
{
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{
			var rec= hr.responseText;
			res1 = rec.split("||");
			res1.shift();
			console.log(res1);
		}
	}
 hr.send("sp_label="+name+"&type="+type);
}

function sp_project(name,type) //get special label after click project or location --- type 1 = label type 2 = location
{
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{
			var rec= hr.responseText;
			res0 = rec.split("||");
			res0.shift();
			console.log(res0);
		}
	}
 hr.send("sp_pro="+name+"&type="+type);
}


function download_checked(path){ //download all checked image
window.location.replace("/download_manage.php?filepath="+path);
}

function remove_path(input){  //get rid of the heck of image path
for(i=0;i<input.length;i++){
	temp=input[i].split("/mnt/data/");
	input[i]=temp[1];
	}
}

function add_path(input){  //get rid of the heck of image path
copy=[];
for(i=0;i<input.length;i++){
	copy.push("/mnt/data/"+input[i]);
	}
	return copy;
}


////////////////////////////////
// experimental area, high level permission required
function make_one_e(n,text1,head_text,theArray)
{

	//console.log("e version");
	var warp1 = $("<div></div>", { class: "dropdown", id:"pre_text"+n});
	var warp2 = $("<button></button>", { 
	class: "btn btn-default dropdown-toggle",
	type: "button",
	id: "menu"+n,
	"data-toggle": "dropdown",
	text: text1
	});
	var span= $("<span></span>", {class: "caret",id:"ss"});
	var warp3 = $("<ul></ul>", { 
	class: "dropdown-menu",
	role:"menu",
	"aria-labelledby":"menu"+n,
	id: "mme"+n
	});
	var warp4 = $("<nav></nav>", { class: "navbar navbar-default"});
	var warp5 = $("<div></div>", { class: "container-fluid"});
	var warp5_1 = $("<div></div>", { id:"nav_bar"+n});
	var warp5_2 = $("<div></div>", { id:"selection-page"+n});
	var warp5_1_1 =$("<div></div>", { class: "navbar-header"});
	var warp5_1_2 =$("<ul></ul>", { class: "nav navbar-nav",id:"ini_nav"+n});
	var warp5_2_1 =$("<ul></ul>", { class: "nav navbar-nav"});
	var warp5_1_1_1 =$("<a></a>", { class: "navbar-brand",href:"#", id:"head"+n,text:head_text});
			
	warp5_1_1_1.appendTo(warp5_1_1);
	warp5_1_1.appendTo(warp5_1);
	warp5_1_2.appendTo(warp5_1);
	warp5_2_1.appendTo(warp5_2);
	warp5_1.appendTo(warp5);
	warp5_2.appendTo(warp5);


	warp5.appendTo(warp4);
	warp4.appendTo(warp3);
		
	span.appendTo(warp2);   
	warp2.appendTo(warp1);
	warp3.appendTo(warp1); 
	////  nav bar ini_letter part
	////

	sim_label=[];    
	for (i=0;i<theArray.length;i++)
		{
			//console.log("reach here");
			sim_label.push(theArray[i][0].toUpperCase());
		}  
	sim_label = sim_label.reverse().filter(function (e, i, arr) {return arr.indexOf(e, i+1) === -1;}).reverse();
	console.log(sim_label);	
	for (i=0;i<sim_label.length;i++)
		{
			var block = $("<li></li>", {});
			var block_info = $("<a></a>", { 'text': sim_label[i],'href':"#" });
			block_info.appendTo(block);
			block.appendTo(warp5_1_2);
		}
				
	///
	/// pass into function part

	return warp1;
}

function add_on_e(n,event_stop,i,inside_fun,theArray,add_n) //add_on to remove label
{
$("#mme"+n).on("click", function (event) {
		//console.log(event_stop);
		if(event_stop[i])
		{event.stopPropagation();}
		else {event.originalEvent;event_stop[i]=true;}
	  });
		var str = theArray; 
	  var all_img = $("#nav_bar"+n)[0].getElementsByTagName("a");
	  for (i = 0; i < (all_img.length); i++) {
		all_img[i].onclick = function () {
		  var ob = $("#selection-page"+n)[0].children[0];
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
		        event_stop[i]=false;
		        console.log("cur label: "+$(this).text());
		        if(add_n)
		        {inside_fun($(this).text(),n);}
		        else{inside_fun($(this).text());}
		        });            
		      block_info.appendTo(block);
		      block.appendTo(ob);
		    }
		  }
		}
	  }
}

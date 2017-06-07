var projectArray; //array contain all project
var pathArray;  // array contain impath of current project
var labelArray;
function getproject(){
console.log("weee");
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
	        projectArray = rec.split("||");
	        projectArray[0]="all projects"
	        console.log("damessss");
		}
	}
hr.send("request=getpro2");
}

function getproject_im2(pro_name,label_name){ //get all image give a label and a project
console.log("pass");
var hr = new XMLHttpRequest();
hr.open("POST", "send.php", true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
hr.onreadystatechange = function() 
	{
	if(hr.readyState == 4 && hr.status == 200) 
		{var rec= hr.responseText;
		console.log(rec);
		//pathArray = rec.split("||"); 
		//pathArray.shift();
		}
	}
 hr.send("p_name="+pro_name+"&l_name"+label_name);
}
function all_labels(){ //get all labels
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
function remove_path(input){  //get rid of the heck of image path
for(i=0;i<input.length;i++){
	temp=input[i].split("/mnt/data/");
	input[i]=temp[1];
	}
}


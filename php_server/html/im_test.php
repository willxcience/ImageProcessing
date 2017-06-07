
<html lang="en">
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
    <meta charset="utf-8">
    <div class="container-fluid" id="main_w">
        <div class="row" id="buttons">
            <div class="col-sm-3" style="background-color:#DFE2DB;height:200px" id="g0">
			<h4 class="text-center">1 </h4>
				  <div class="dropdown">
					select a project
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Select
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="mme">

					  <nav class="navbar navbar-default">
						<div class="container-fluid">
						  <div id="nav_bar">
							<div class="navbar-header">
							  <a class="navbar-brand" href="#">A-Z</a>
							</div>
							<ul class="nav navbar-nav">
							  <li><a href="#">A</a></li>
							  <li><a href="#">B</a></li>
							  <li><a href="#">C</a></li>
							</ul>
						  </div>
						  <div id="selection-page">
							<ul class="nav navbar-nav">
							</ul>
						  </div>
						</div>
					  </nav>

					</ul>
				  </div>
            </div>

            <div class="col-sm-3" style="background-color:#DFE1AB;height:200px">
                <div class="btn-group-lg" id="g1">
			<h4 class="text-center">Select a label</h4>
                </div>
            </div>

            <div class="col-sm-3" style="background-color:#DFE2DB;height:200px">
                <div class="btn-group-lg" id="g2">
			<h4 class="text-center">Select a time</h4>
                </div>
            </div>
            <div class="col-sm-3" style="background-color:#DFE1AB;height:200px">
                <div class="btn-group-lg" id="g2">
			<h4 class="text-center">Select a location</h4>
                </div>
            </div>
        </div>
	<div class="row" id="all_images">
		<div class="row" id="row1">
			 <div class="col-sm-2" >
				<img src="./IMAGEDATA/test/IMG_0001.JPG" class="img-thumbnail my_im" alt="Responsive image" ></img>	
				<label class="btn btn-danger btn-xs btn_my" >
					<input type="checkbox" autocomplete="off" id="a box">
				</label>
			</div>
			 <div class="col-sm-2" >
				<img src="./IMAGEDATA/test4/MDGC0001.JPG" class="img-thumbnail my_im" alt="Responsive image" ></img>
				<label class="btn btn-danger btn-xs btn_my" >
					<input type="checkbox" autocomplete="off" id="two box">
				</label>	
			</div>
			 <div class="col-sm-2" >
			</div>
		</div>
		<div class="row" id="row2">
			 <div class="col-sm-2" >
				<img src="./IMAGEDATA/test4/MDGC0001.JPG" class="img-thumbnail my_im" alt="Responsive image"></img>	
			</div>		
		</div>
	</div>
    </div>
	<div id="myModal" class="modal">
	  <span class="close">&times;</span>
	  <img class="modal-content" id="img01">
	  <div id="caption"></div>
	</div>
</head>
<style>
.btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}
.btn_my {
    position:absolute;
    bottom:0px;
    right:10px;
    width:25px;
    height:25px;
}
</style>
<body>
<script id="source" language="javascript" type="text/javascript">
$('label > input[type=checkbox]').on('change', function () {
    console.log($(this)[0].id);
})
//imge modal
var all_img=$("#all_images")[0].getElementsByTagName("img");
var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (i=0;i<(all_img.length);i++)
{
	all_img[i].onclick = function(){
	    modal.style.display = "block";
	    modalImg.src = this.src;
	    captionText.innerHTML = this.alt;
	}
}
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
    modal.style.display = "none";
}
//image modal
</script>

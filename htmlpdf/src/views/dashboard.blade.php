<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('assets/css/dashboard.css') }}" rel="stylesheet">	

	<style>
 /* The sidebar menu */
.sidebar {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0;
  left: 0;
  background-color: #111; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
}

/* The sidebar links */
.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  /*font-size: 25px;*/
  font-size: 12px;  
  /*color: #818181;*/
  color: white;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidebar a:hover {
  /*color: #f1f1f1;*/
  color: #000;
}

/* Position and style the close button (top right corner) */
.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  /*font-size: 36px;*/
  font-size: 12px;
  margin-left: 50px;
}

/* The button used to open the sidebar */
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s; /* If you want a transition effect */
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
/*@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
} 	
*/
	</style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">						@if(!empty($workspaceName))
		  {{ $workspaceName }}
		@endif</a>
		   <button class="openbtn" onclick="openNav()">&#9776;</button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/') }}">Workspace</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
		 <div id="mySidebar" class="sidebar">
			  <ul class="nav nav-sidebar">
				<li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
				<li><a href="#">Reports</a></li>
				<li><a href="#">Analytics</a></li>
				<li><a href="#">Export</a></li>
				<li><a href="#" onclick="$('#createTableButton').click();">Create Table</a></li>
				<li><a href="#">Change Sequence</a></li>
			  </ul>

			  <?php echo $sidebar; ?>
		</div>
		<div id="main">
			<div class="row">
				<div class="col-sm-12 main">
				  <div class="row placeholders">
					<div class="col-xs-6 col-sm-6 placeholder" style="border:1px solid #ccc;">
					<h2 class="sub-header">Html View</h2>            
					</div>
					<div class="col-xs-6 col-sm-6 placeholder" style="border:1px solid #ccc;">
					<h2 class="sub-header">Pdf View</h2>
					</div>
					<div class="col-xs-6 col-sm-6 placeholder" style="border:1px solid #ccc; height: 630px; text-align: left;">
					  <div id="textbox"></div>
					  <br/>
					  <div style="padding:10px; border:1px solid #ccc; text-align:left;">
						Table Id: <span id="tTableid" style="border:1px solid #ccc;"></span>
						&nbsp;&nbsp;Row Id: <span id="tRowid" style="border:1px solid #ccc;"></span>
						&nbsp;&nbsp;Column Id: <span id="tColumnid" style="border:1px solid #ccc;"></span>&nbsp;&nbsp;
						<a href="{{ url('tcpdf_gen/'.$iWorkspaceid) }}" target="_blank" style="text-decoration:none;">Preview</a>
						<button style="float:right;" onclick="saveHtml();">save</button>
					  </div>
					</div>
					<div id="example1" class="col-xs-6 col-sm-6 placeholder" style="border:1px solid #ccc; height: 630px; padding-left: 0px; padding-right:0px;">
					  <iframe id="myIFrame" width="100%" height="100%"></iframe>
					</div>            
				  </div>
				</div>
			</div>
		 </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="{{ url('assets/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <!-- include summernote css/js -->
    <link href="{{ url('assets/css/summernote.css') }}" rel="stylesheet">
    <script src="{{ url('assets/js/summernote.js') }}"></script>    
  </body>
</html>

<script>
$(document).ready(function() {
  $('#textbox').summernote({
    height: 300
  });
});
</script>

<script>
function saveHtml(){
  var w = '<?php echo $iWorkspaceid ?>';
  var a = $("#tTableid").text();
  var b = $("#tRowid").text();
  var c = $("#tColumnid").text();
  var columnhtml = $('#textbox').summernote('code');
  $.ajax({
    url: "{{ url('/saveColumnHtmlData') }}",
    type: 'post',
    data: {
	  workspaceid: w,
      tableid: a,
      rowid: b,
      columnid: c,
      columnhtml: columnhtml,
      context: 'savehtml',
	  _token: '{{ csrf_token() }}'

    },
    success: function(res){
      if(res == '1' | 1){
		$("#myIFrame").attr('src',"{{ url('/tcpdf_gen/'.$iWorkspaceid) }}");
      }
      else {
        $("#myIFrame").attr('src','');
      }
    }
  });
}
</script>

<script>
function getHtml(a,b,c){
  $("#tTableid").text(a);
  $("#tRowid").text(b);
  $("#tColumnid").text(c);  
  $.ajax({
    url: "{{ url('/getColumnHtmlData') }}",
    type: 'post',
    data: {
      tableid: a,
      rowid: b,
      columnid: c,
      context: 'html',
	  _token: '{{ csrf_token() }}'

    },
    success: function(res){
      $('#textbox').summernote('code', res);
    }
  });
}
</script>

<!-- Trigger the modal with a button -->
<button id="createTableButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createTableModal" style="display:none;">Open Modal</button>

<!-- Modal -->
<div id="createTableModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Row Detail</h4>
      </div>
      <div class="modal-body">
        <table style="border-collapse:collapse;">
          <tbody>
            <tr>
              <td style="width:60px;">Columns</td>
              <td><input id="colCount" type="text" style="border:1px solid #ccc; height: 20px; width: 100px;"><button onClick="createTableRequest();">Add</button></td>
            </tr>
            <tr>
              <td colspan="2"><div id="structHtml"></div></td>
            </tr>            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
  function createTableRequest(){
	var count = $("#colCount").val();	
	if(count > 0 && count <= 5){
		$.ajax({
		  url: "{{ url('/createTableRequest') }}",
		  type: 'post',
		  data: {
			table: count,
			context: 'createtable',
			_token: '{{ csrf_token() }}'
		  },
		  success: function(res){
			console.log(JSON.parse(res));
		  }
		});
	} else {
		alert('Please insert column value between 1 and 5');
	}
  }
</script>

<script>
var sidebar_state = 0;
document.getElementById("mySidebar").style.display = "none";
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
	if(sidebar_state == 0){
		sidebar_state = 1;
	  document.getElementById("mySidebar").style.width = "250px";
	  document.getElementById("main").style.marginLeft = "250px";
	  document.getElementById("mySidebar").style.display = "block";
	} else {
		sidebar_state = 0;
		closeNav();
	}
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("mySidebar").style.display = "none";
}

openNav();
</script>
<html>
<head>
    <title>List of products</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!--- https://eternicode.github.io/bootstrap-datepicker/ --->
	<link rel="stylesheet" href="/template/css/style.css">
	<script type="text/javascript" src="/template/js/notify.min.js"></script>
	
	<script type="text/javascript">
	$('#myModal').on('shown.bs.modal', function () {
		$('#myInput').focus()
	})
	$('#removeConfirm').on('shown.bs.modal', function () {
		$('#myInput').focus()
	})
	$(document).ready(function () {
		$('#addAdminModal').hide();
	});
	
	function addAdmin() {
	$(document).ready(function () {
	var newData = {
		login: $('#loginNew').val(),
		email: $('#emailNew').val(),
		password: $('#passwordNew').val(),
	};
           $.post({
				url: 'engine/pages/admin_act.php?add',
                data: newData,
                success: function (data) {
				var result = JSON.parse(data);
                     if (result['status'] == 'success') {
						$('#allAdmins tr:first').after(result['data']);
						alert('success', 'Good!', "Admin was added");
					 } else if (result['status'] == 'failed') {
						alert('danger', 'Error occured...', result['reason']);
					 }
                  }
              });
        });
   }
	
	function edit(id) {
	$(document).ready(function () {
	$('#changeButton').show();
           $.post({
				url: 'engine/pages/admin_act.php?edit='+id,
                data: {"id":id},
                success: function (data) {
                     $('#modal-content').html(data);
					 $('#changeButton').attr('onClick', 'change('+id+');');
                  }
              });
        });
   }
   
   function change(id) {
   $(document).ready(function () {
   var data = {"login":$('#login'+id).val(),"password":$('#password'+id).val(),"email":$('#email'+id).val(),}
           $.post({
				url: 'engine/pages/admin_act.php?change='+id,
                data: data,
                success: function (data) {
					var result = JSON.parse(data);
					if (result['status'] == 'success') {
						alert('success', 'Good!', 'Data successfully changed!');
						$('#modal-content').html('');
						$('#myModal').modal('hide');
						$('#changeButton').hide();
						updateAdmin(result['id'], result['data'], result['category_name']);
					} else if (result['status'] == 'failed') {
						alert('danger', 'Error occured...', 'Data not changed!');
						$('#myModal').modal('hide');
						$('#changeButton').hide();
					}
                  },
				  error: function(data) {
					alert('danger', 'Error occured...', 'Data not changed!');
					$('#myModal').modal('hide');
					$('#changeButton').hide();
				  },
              });
        });
   }
   
   function remove(id,confirm) {
	if (confirm == 0) {
		$('#removeConfirm').modal('show');
		$('#removeButton').attr('onClick', 'remove('+id+',1);');
	} else if (confirm == 1) {
		$('#removeConfirm').modal('hide');
	   $.post({
			url: 'engine/pages/admin_act.php?remove='+id,
			// data: data,
			success: function (data) {
				var result = JSON.parse(data);
				if (result['status'] == 'success') {
					alert('success', '', 'Admin #'+id+' successfully deleted!');
					$('#row'+id).remove();
				} else if (result['status'] == 'failed') {
					alert('danger', 'Error occured...', 'Admin not deleted!');
				}
			  },
			  error: function(data) {
				alert('danger', 'Error occured...', 'Data not changed!');
				$('#myModal').modal('hide');
				$('#changeButton').hide();
			  },
		  });	
	}
   }
   
   function alert(status,header,message) {
   $.notify({
		title: '<strong>'+header+'</strong>',
		message: message,
		newest_on_top: true,
			animate: {
				enter: 'animated bounceInDown',
				exit: 'animated bounceOutUp'
			}
	},{
		type: status,
		delay: 3000,
	});
   }
   
   function updateAdmin(id,data) {
		$('#login'+id).html(data['login']);
		$('#email'+id).text(data['email']);
   }
   
	function addAdminModal() {
		if( $('#addAdminModal').is(':visible') ) { 
			$('#addAdminModal').fadeOut().hide(); 
		} else {
			$('#addAdminModal').fadeIn().show();
		}
	}
	
</script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Butalex Course Work ©</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
			<li><a href="#" onClick="addAdminModal();">New Admin</a></li>
			<li><a href="/admin.php">Admins</a></li>
			<li><a href="/index.php">Products</a></li>
            <li><a href="http://butalex.com/" target="_blank">About me</a></li>
			<li><a href="/login.php?exit">Exit</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change data</h4>
      </div>
      <div class="modal-body" id="modal-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="changeButton" class="btn btn-primary" tabindex="-1">Change</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabelRemove">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">You are serious need remove this admin?</h4>
      </div>
      <div class="modal-body" id="modal-remove">
	    <button type="button" class="btn btn-default btn-block" data-dismiss="modal" tabindex="-1">Close</button>
        <button type="button" id="removeButton" class="btn btn-danger btn-block" onClick="remove()">I'm serious! Remove!</button>
      </div>
    </div>
  </div>
</div>

<div id="addAdminModal" class="container">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Add new admin</h3>
  </div>
  <div class="panel-body">
    <form id="formNew" class="form-horizontal">
		<div class="form-group">
			<label for="loginNew" class="col-sm-2 control-label">Login:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="loginNew" tabindex="1">
			</div>
		</div>
		<div class="form-group">
			<label for="passwordNew" class="col-sm-2 control-label">Password:</label>
			<div class="col-sm-10">
			<input type="password" class="form-control" id="passwordNew" tabindex="4">
			</div>
		</div>
		<div class="form-group">
			<label for="emailNew" class="col-sm-2 control-label">E-mail:</label>
			<div class="col-sm-10">
			<input type="email" class="form-control" id="emailNew" tabindex="5">
			</div>
		</div>
		<div class="col-sm-2">
		</div>
		<div class="col-sm-10">
			<button type="button" id="addButton" onClick="addAdmin();" class="btn btn-primary btn-block" tabindex="-1">Add</button>
		</div>
	</form>
  </div>
</div>
</div>

<div class="container">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title">List of products</h3></div>
	<?= $all_admins_tpl ;?>
</div>
</body>
</html>
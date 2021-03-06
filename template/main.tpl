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
		$('#addProd').hide();
	});
	
	function addProduct() {
	$(document).ready(function () {

	var newData = {
		name: $('#nameNew').val(),
		descr: $('#descrNew').val(),
		category: $('#categoryNew option:selected').val(),
		count: $('#countNew').val(),
		price: $('#priceNew').val(),
		wholeprice: $('#wholepriceNew').val(),
	};
           $.post({
				url: 'engine/pages/actions.php?add',
                data: newData,
                success: function (data) {
				var result = JSON.parse(data);
                     if (result['status'] == 'success') {
						$('#allProducts tr:first').after(result['data']);
					 }
                  }
              });
        });
   }
	
	function edit(id) {
	$(document).ready(function () {
	$('#changeButton').show();
           $.post({
				url: 'engine/pages/actions.php?edit='+id,
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
   var data = {"name":$('#name'+id).val(),"descr":$('#descr'+id).val(), "category":$('#category'+id+' option:selected').val(), "count":$('#count'+id).val(),"price":$('#price'+id).val(),"wholeprice":$('#wholeprice'+id).val(),}
           $.post({
				url: 'engine/pages/actions.php?change='+id,
                data: data,
                success: function (data) {
					var result = JSON.parse(data);
					if (result['status'] == 'success') {
						alert('success', 'Good!', 'Data successfully changed!');
						$('#modal-content').html('');
						$('#myModal').modal('hide');
						$('#changeButton').hide();
						updateProducts(result['id'], result['data'], result['category_name']);
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
			url: 'engine/pages/actions.php?remove='+id,
			// data: data,
			success: function (data) {
				var result = JSON.parse(data);
				if (result['status'] == 'success') {
					alert('success', '', 'Product #'+id+' successfully deleted!');
					$('#row'+id).remove();
				} else if (result['status'] == 'failed') {
					alert('danger', 'Error occured...', 'Product not deleted!');
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
   
   function updateProducts(id,data, category) {
		$('#name'+id).html(data['name']);
		$('#descr'+id).text(data['descr']);
		$("#category"+id).html(category);
		$('#count'+id).text(data['count']);
		$('#price'+id).text(data['price']);
		$('#wholeprice'+id).text(data['wholeprice']);
   }
   
	function addProd() {
		if( $('#addProd').is(':visible') ) { 
			$('#addProd').fadeOut().hide(); 
		} else {
			$('#addProd').fadeIn().show();
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
			<li><a href="#" onClick="addProd();">New Product</a></li>
			<li><a href="/admin.php">Admins</a></li>
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
        <h4 class="modal-title" id="myModalLabel">You are serious need remove this item?</h4>
      </div>
      <div class="modal-body" id="modal-remove">
	    <button type="button" class="btn btn-default btn-block" data-dismiss="modal" tabindex="-1">Close</button>
        <button type="button" id="removeButton" class="btn btn-danger btn-block" onClick="remove()">I'm serious! Remove!</button>
      </div>
    </div>
  </div>
</div>

<div id="addProd" class="container">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Add new product</h3>
  </div>
  <div class="panel-body">
    <form id="formNew" class="form-horizontal">
		<div class="form-group">
			<label for="nameNew" class="col-sm-2 control-label">Name:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="nameNew" tabindex="1">
			</div>
		</div>
		<div class="form-group">
			<label for="descrNew" class="col-sm-2 control-label">Description:</label>
			<div class="col-sm-10">
			<textarea type="text" class="form-control" id="descrNew" tabindex="2"></textarea>
			</div>
		</div>
		<div class="form-group">
		<label for="cats" class="col-sm-2">Categories:</label>
			<div class="col-sm-10">
				<select class="form-control" id="categoryNew">
					<option>---Select---</option>
					<?= $listOfCategories?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="countNew" class="col-sm-2 control-label">Count of products:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="countNew" tabindex="3">
			</div>
		</div>
		<div class="form-group">
			<label for="priceNew" class="col-sm-2 control-label">Price:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="priceNew" tabindex="4">
			</div>
		</div>
		<div class="form-group">
			<label for="WholepriceNew" class="col-sm-2 control-label">Wholeprice:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="wholepriceNew" tabindex="5">
			</div>
		</div>
		<div class="col-sm-2">
		</div>
		<div class="col-sm-10">
			<button type="button" id="addButton" onClick="addProduct();" class="btn btn-primary btn-block" tabindex="-1">Add</button>
		</div>
	</form>
  </div>
</div>
</div>

<div class="container">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title">List of products</h3></div>
	<?= $all_products_tpl ;?>
</div>
</body>
</html>
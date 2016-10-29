<html>
<head>
    <title>List of products</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!--- https://eternicode.github.io/bootstrap-datepicker/ --->
	<link rel="stylesheet" href="/template/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.ru.min.js"></script>
	<script type="text/javascript" src="/template/js/notify.min.js"></script>
	<script type="text/javascript">
	$('#myModal').on('shown.bs.modal', function () {
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
						$('#allProducts tr:first').after('<tr><td>'+result['data']['id']+'</td><td id="name'+result['data']['id']+'">'+result['data']['name']+'</td><td id="descr'+result['data']['id']+'">'+result['data']['descr']+'</td><td id="count'+result['data']['id']+'">'+result['data']['count']+'</td><td id="price'+result['data']['id']+'">'+result['data']['price']+'</td><td id="wholeprice'+result['data']['id']+'">'+result['data']['wholeprice']+'</td><td><button class="btn btn-default" id="'+result['data']['id']+'" onClick="edit('+result['data']['id']+')" data-toggle="modal" data-target="#myModal">Edit</button></td></tr>');
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
   var data = {"name":$('#name'+id).val(),"descr":$('#descr'+id).val(),"count":$('#count'+id).val(),"price":$('#price'+id).val(),"wholeprice":$('#wholeprice'+id).val(),}
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
						updateProducts(result['id'], result['data']);
					} else if (result['status'] == 'error') {
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
   
   function updateProducts(id,data) {
		$('#name'+id).html(data['name']);
		$('#descr'+id).text(data['descr']);
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
            <li><a href="http://butalex.com/" target="_blank">About me</a></li>
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
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="modal-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="changeButton" class="btn btn-primary">Change</button>
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
			<input type="text" class="form-control" id="nameNew">
			</div>
		</div>
		<div class="form-group">
			<label for="descrNew" class="col-sm-2 control-label">Description:</label>
			<div class="col-sm-10">
			<textarea type="text" class="form-control" id="descrNew"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="countNew" class="col-sm-2 control-label">Count of products:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="countNew">
			</div>
		</div>
		<div class="form-group">
			<label for="priceNew" class="col-sm-2 control-label">Price:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="priceNew">
			</div>
		</div>
		<div class="form-group">
			<label for="WholepriceNew" class="col-sm-2 control-label">Wholeprice:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="wholepriceNew">
			</div>
		</div>
		<div class="col-sm-2">
		</div>
		<div class="col-sm-10">
			<button type="button" id="addButton" onClick="addProduct();" class="btn btn-primary btn-block">Add</button>
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
<?php if(!defined('MAINDIR')) die('USE MAIN SCRIPT!'); 

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			  <div class="panel panel-default">
				  <div class="panel-body">
					<button class="btn btn-default" data-toggle="modal" data-target="#searchTVDB">Добавить с TVDB</button>
				  </div>
			  </div>
			  <div class="panel panel-default">
				  <div class="panel-body">
					Basic panel example
				  </div>
			  </div>
		</div>
	</div>
</div>
<script>
function SearchTvDB() {
	var sText = $('#tvdbSearch1').val();
	$.ajax({
    url: 'metamodules/tvdb/search.php',
    data: {title: sText},
    dataType: 'html',
	success: TvdbGood,
	});
}
function TvdbGood(data) {
	$('#tvdbOut').html(data);
}
</script>
<div class="modal fade" id="searchTVDB" tabindex="-1" role="dialog" aria-labelledby="tvdbLable">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tvdbLable">TvDB Add</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input type="text" class="form-control" id="tvdbSearch1" placeholder="Search for...">
					<span class="input-group-btn">
					<button class="btn btn-default" onclick="SearchTvDB();" type="button">Go!</button>
					</span>
				</div>
				<div id="tvdbOut">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			</div>
		</div>
	</div>
</div>
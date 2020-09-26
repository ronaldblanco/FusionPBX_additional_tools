<?php

//includes
include_once "root.php";
require_once "resources/require.php";
require_once "resources/check_auth.php";
require_once "resources/paging.php";

$rows = false;
$database = new database;
$default ='';
//var_dump($_POST['query']);
//$sql = "select * from v_extensions";
if(isset($_POST['query']) && $_POST['query'] != ''){
	$sql = $_POST['query'];
	$rows = $database->select($sql);
	$default = $sql;
}
//var_dump($default);

require_once "resources/header.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Database Query!</title>
	<link id="favicon" rel="shortcut icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAhFBMVEUAAAAAAAD////p6ekLCwt+fn43NzccHBzT09PIyMjFxcWysrKnp6ekpKSfn5+ampqNjY2IiIiCgoJ0dHRubm5kZGRdXV1PT09JSUlEREQjIyMTExMHBwf7+/v19fXg4ODW1tbAwMCRkZGDg4N5eXloaGhTU1M+Pj4vLy8sLCwlJSURERGNXQbaAAAAAXRSTlN4HjghaAAAAI1JREFUGNNlz0cSwkAQQ9HRdyI542xyhvvfj5opFoC167dolYzRT/5v6Qui+P6Bp3wLDakDPwM4SQGdA2B1mdFqgRw0C3wNHMVB9dr+wJMeFCHpBiqjG4n8PVEAQU5klOPtoNacpTxPRjOSrBoleA3EtmUrm5C5rpQyHSsHBWeV2JZ2lEsvhctek3GT+W8jMQY7SBmDowAAAABJRU5ErkJggg==">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/style.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/lint.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/dialog/dialog.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/jstree.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/javascript/javascript.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/css/css.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/php/php.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/xml/xml.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/htmlmixed/htmlmixed.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/markdown/markdown.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/clike/clike.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jshint/2.10.2/jshint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jsonlint/1.6.0/jsonlint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/lint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/javascript-lint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/json-lint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/css-lint.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/search.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/searchcursor.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/jump-to-line.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/dialog/dialog.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	
</head>

<body>
	<h2>PSQL Query!</h2>
	<h4>Last Query Executed: <?php echo $default;?></h4>
	</br>
	<form action="sjdhashbvbq78vew8vbe02jenlvewbvdjvwcheck_database.php" class='inline' method="post" styles>
						<div class="form-group">
							<label>SQL Query:</label>
							<textarea class="form-control" name="query" placeholder="Query" value="<?php echo $default; ?>" rows="5" style="width: 100%"></textarea>
							<small id="SMS" class="form-text text-muted">Query to execute!</small>
						</div>
        				<input type="submit" class="btn btn-primary" value="Execute">
    				</form>
		</br>
		
		<?php 
	//$rows_key = array_keys($rows); 
	if($rows != false){
	?>
	<br/>
	<table class="list table table-striped table-bordered table-hover">
	<thead class="thead-dark">
	<tr>
		<?php
		
		$rows_key = array_keys($rows[0]);
		for($i = 0;$i < count($rows_key);$i++){
		?>
	  		<th scope="col"><?php echo $rows_key[$i]; ?></th>
		<?php } ?>
	  
    </tr>	
	</thead>
	<tbody>
	<?php foreach ($rows as $row): array_map('htmlentities', $row);?>
	<tr>
		<?php
		$keys = array_keys($row);
		for($j = 0;$j < count($keys);$j++){
		?>
	  <th scope="row"><?php echo $row[$keys[$j]]; //echo implode('</td><td>', $row);?></th>
	  <!--<td><?php //echo $row['extension']; ?></td>
	  <td><?php //echo $row['effective_caller_id_name']; ?></td>-->
		<?php } ?>
    </tr>
	<?php 
			endforeach;
		?>
	</tbody>
	</table>	
		<?php } ?>
</br>
<h6>Information:</h6></br>
<h8>
		Connect to postgres database psql -h postgresql.guebs.net -U user_name -d database_name</br>
		Listar Schemas	\dn</br>
		Connect to a database	\c __base_datos__</br>
		List databases	\l</br>
		Show tables in database \dt</br>
		Show table definition including triggers	\d __table__</br>
		List functions	\df</br>
		List views	\dv</br>
		Show function SQL code	\df+ __function</br>
		Pretty-format	\x</br>
		Close conection	\q</br>
	</h8>
	
	</br>
	<img src="/zzzdatabase_query/Screenshot_2.png" alt="FusionPBX tables" width="500" height="900"></br>
	<img src="/zzzdatabase_query/Screenshot_3.png" alt="FusionPBX tables" width="500" height="500">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
//include the footer
	require_once "resources/footer.php";
?>

</body>

</html>
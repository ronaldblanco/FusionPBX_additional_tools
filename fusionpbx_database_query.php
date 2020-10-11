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

if(isset($_POST['query']) && $_POST['query'] != ''){
	
	$finalquery = str_replace(";", "", $_POST['query']);
	$select = strpos($_POST['query'], 'select');
	$update = strpos($_POST['query'], 'update');
	$insert = strpos($_POST['query'], 'insert into');
	$delete = strpos($_POST['query'], 'delete');
	$limit = strpos($_POST['query'], 'limit');
	
	if($limit === false) $finalquery = $finalquery . " limit 50;";
	if($limit !== false) $finalquery = $finalquery . ";";
	
	$myquerys = fopen("sjdhashbvbqquerys_history.txt", "a+") or die("Unable to open file!");
	fwrite($myquerys, $finalquery.PHP_EOL);
	
	$sql = $finalquery;
	if($select !== false) $rows = $database->select($sql);
	else $message = '<div class="alert alert-warning" role="alert"> Only Select operations are allowed!</div>';
	//if($update !== false) $rows = $database->execute($sql);
	//if($insert !== false) $rows = $database->execute($sql);
	//var_dump($rows);
	$default = $sql;
}
//var_dump($default);

/*
//update devices having extension assigned to line(s) with new password
					if ($action == "update" && $range == 1 && permission_exists('extension_password')) {
						$sql = "update v_device_lines set ";
						$sql .= "password = :password ";
						$sql .= "where domain_uuid = :domain_uuid ";
						$sql .= "and server_address = :server_address ";
						$sql .= "and user_id = :user_id ";
						$parameters['password'] = $password;
						$parameters['domain_uuid'] = $_SESSION['domain_uuid'];
						$parameters['server_address'] = $_SESSION['domain_name'];
						$parameters['user_id'] = $extension;
						$database = new database;
						$database->execute($sql, $parameters);
						unset($sql, $parameters);
					}
*/

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
	<?php
		if(isset($message))echo $message;
	?>
	<h2>PSQL Query!</h2>
	</br>
	<form action="sjdhashbvbq78vew8vbe02jenlvewbvdjvwcheck_database.php" class='inline' method="post" styles id="queryform">
						<div class="form-group">
							<label>SQL SELECT Query:</label>
							<textarea class="form-control" name="query" placeholder="Query" value="<?php echo $default; ?>" rows="5" style="width: 400%"><?php echo $default; ?></textarea>
							 <input type="hidden" id="warning" name="warning" value="warning">
							<small id="query" class="form-text text-muted">Query to execute!</small>
						</div>
        				<input type="submit" class="btn btn-primary" value="Execute" id="warning_message">
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
<h6>Lasts Querys Executed: </h6>
	<?php
		$myfile = fopen("sjdhashbvbqquerys_history.txt", "r");
		$history = explode(";",fread($myfile,filesize("sjdhashbvbqquerys_history.txt")));
		//var_dump($history);
		fclose($myfile);
		for($i = 0;$i < count($history);$i++){
			echo $history[$i].';</br>';
		}
	?>
<?php fclose($myquerys);?>
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

 List of relations</br>
 Schema |              Name               | Type  |   Owner</br>
--------+---------------------------------+-------+-----------</br>
 public | v_access_control_nodes          | table | fusionpbx</br>
 public | v_access_controls               | table | fusionpbx</br>
 public | v_bridges                       | table | fusionpbx</br>
 public | v_call_block                    | table | fusionpbx</br>
 public | v_call_broadcasts               | table | fusionpbx</br>
 public | v_call_center_agents            | table | fusionpbx</br>
 public | v_call_center_queues            | table | fusionpbx</br>
 public | v_call_center_tiers             | table | fusionpbx</br>
 public | v_call_flows                    | table | fusionpbx</br>
 public | v_call_recordings               | table | fusionpbx</br>
 public | v_conference_centers            | table | fusionpbx</br>
 public | v_conference_control_details    | table | fusionpbx</br>
 public | v_conference_controls           | table | fusionpbx</br>
 public | v_conference_profile_params     | table | fusionpbx</br>
 public | v_conference_profiles           | table | fusionpbx</br>
 public | v_conference_rooms              | table | fusionpbx</br>
 public | v_conference_session_details    | table | fusionpbx</br>
 public | v_conference_sessions           | table | fusionpbx</br>
 public | v_conference_users              | table | fusionpbx</br>
 public | v_conferences                   | table | fusionpbx</br>
 public | v_contact_addresses             | table | fusionpbx</br>
 public | v_contact_attachments           | table | fusionpbx</br>
 public | v_contact_emails                | table | fusionpbx</br>
 public | v_contact_groups                | table | fusionpbx</br>
 public | v_contact_notes                 | table | fusionpbx</br>
 public | v_contact_phones                | table | fusionpbx</br>
 public | v_contact_relations             | table | fusionpbx</br>
 public | v_contact_settings              | table | fusionpbx</br>
 public | v_contact_times                 | table | fusionpbx</br>
 public | v_contact_urls                  | table | fusionpbx</br>
 public | v_contact_users                 | table | fusionpbx</br>
 public | v_contacts                      | table | fusionpbx</br>
 public | v_countries                     | table | fusionpbx</br>
 public | v_database_transactions         | table | fusionpbx</br>
 public | v_databases                     | table | fusionpbx</br>
 public | v_default_settings              | table | fusionpbx</br>
 public | v_destinations                  | table | fusionpbx</br>
 public | v_device_keys                   | table | fusionpbx</br>
 public | v_device_lines                  | table | fusionpbx</br>
 public | v_device_profile_keys           | table | fusionpbx</br>
 public | v_device_profile_settings       | table | fusionpbx</br>
 public | v_device_profiles               | table | fusionpbx</br>
 public | v_device_settings               | table | fusionpbx</br>
 public | v_device_vendor_function_groups | table | fusionpbx</br>
 public | v_device_vendor_functions       | table | fusionpbx</br>
 public | v_device_vendors                | table | fusionpbx</br>
 public | v_devices                       | table | fusionpbx</br>
 public | v_dialplan_details              | table | fusionpbx</br>
 public | v_dialplans                     | table | fusionpbx</br>
 public | v_domain_settings               | table | fusionpbx</br>
 public | v_domains                       | table | fusionpbx</br>
 public | v_email_logs                    | table | fusionpbx</br>
 public | v_email_templates               | table | fusionpbx</br>
 public | v_extension_users               | table | fusionpbx</br>
 public | v_extensions                    | table | fusionpbx</br>
 public | v_fax                           | table | fusionpbx</br>
 public | v_fax_files                     | table | fusionpbx</br>
 public | v_fax_logs                      | table | fusionpbx</br>
 public | v_fax_tasks                     | table | fusionpbx</br>
 public | v_fax_users                     | table | fusionpbx</br>
 public | v_follow_me                     | table | fusionpbx</br>
 public | v_follow_me_destinations        | table | fusionpbx</br>
 public | v_gateways                      | table | fusionpbx</br>
 public | v_group_permissions             | table | fusionpbx</br>
 public | v_groups                        | table | fusionpbx</br>
 public | v_ivr_menu_options              | table | fusionpbx</br>
 public | v_ivr_menus                     | table | fusionpbx</br>
 public | v_languages                     | table | fusionpbx</br>
 public | v_meeting_users                 | table | fusionpbx</br>
 public | v_meetings                      | table | fusionpbx</br>
 public | v_menu_item_groups              | table | fusionpbx</br>
 public | v_menu_items                    | table | fusionpbx</br>
 public | v_menu_languages                | table | fusionpbx</br>
 public | v_menus                         | table | fusionpbx</br>
 public | v_message_media                 | table | fusionpbx</br>
 public | v_messages                      | table | fusionpbx</br>
 public | v_modules                       | table | fusionpbx</br>
 public | v_music_on_hold                 | table | fusionpbx</br>
 public | v_notifications                 | table | fusionpbx</br>
 public | v_number_translation_details    | table | fusionpbx</br>
 public | v_number_translations           | table | fusionpbx</br>
 public | v_permissions                   | table | fusionpbx</br>
 public | v_phrase_details                | table | fusionpbx</br>
 public | v_phrases                       | table | fusionpbx</br>
 public | v_pin_numbers                   | table | fusionpbx</br>
 public | v_recordings                    | table | fusionpbx</br>
 public | v_ring_group_destinations       | table | fusionpbx</br>
 public | v_ring_group_users              | table | fusionpbx</br>
 public | v_ring_groups                   | table | fusionpbx</br>
 public | v_settings                      | table | fusionpbx</br>
 public | v_sip_profile_domains           | table | fusionpbx</br>
 public | v_sip_profile_settings          | table | fusionpbx</br>
 public | v_sip_profiles                  | table | fusionpbx</br>
 public | v_sms_broadcast                 | table | fusionpbx</br>
 public | v_sms_destinations              | table | fusionpbx</br>
 public | v_sms_messages                  | table | fusionpbx</br>
 public | v_software                      | table | fusionpbx</br>
 public | v_streams                       | table | fusionpbx</br>
 public | v_user_groups                   | table | fusionpbx</br>
 public | v_user_settings                 | table | fusionpbx</br>
 public | v_users                         | table | fusionpbx</br>
 public | v_vars                          | table | fusionpbx</br>
 public | v_voicemail_destinations        | table | fusionpbx</br>
 public | v_voicemail_greetings           | table | fusionpbx</br>
 public | v_voicemail_messages            | table | fusionpbx</br>
 public | v_voicemail_options             | table | fusionpbx</br>
 public | v_voicemails                    | table | fusionpbx</br>
 public | v_xml_cdr                       | table | fusionpbx</br></br>


	<!--<img src="/zzzdatabase_query/Screenshot_2.png" alt="FusionPBX tables" width="500" height="900"></br>
	<img src="/zzzdatabase_query/Screenshot_3.png" alt="FusionPBX tables" width="500" height="500">-->

<script>
	$( "#warning_message" ).click(function(e) {
  	e.preventDefault();
	if (confirm("You are about to run a database query, are you sure?")) {
      $('#queryform').submit();
    } else {
	}
});
</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
//include the footer
	require_once "resources/footer.php";
?>

</body>

</html>

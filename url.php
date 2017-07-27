<?php
	include "config.php";

	function id_to_hash($id) 
	{
		$id = base_convert($id, 10, 36);
		$id = base64_encode($id);
		$id = str_replace('=', '', $id);
		
		return $id;
	}

	if (isset($_POST['url'])) {
						
		$url = mysqli_real_escape_string($mysqli, $_POST['url']);
				
		$result = mysqli_query($mysqli, "SELECT * FROM urllist WHERE url='$url' LIMIT 1");
		if (!mysqli_error($mysqli) && mysqli_affected_rows($mysqli) > 0) {
			$myrow = mysqli_fetch_assoc($result);
			$hash = $myrow['hash'];
		} else {
			if (isset($_POST['text'])) {
				$hash = mysqli_real_escape_string($mysqli, $_POST['text']);
				$result = mysqli_query($mysqli, "INSERT INTO urllist SET url='$url', hash='$hash'");
			} else {
				$result = mysqli_query($mysqli, "INSERT INTO urllist SET url='$url'");
				$id = mysqli_insert_id($mysqli);
				$hash = id_to_hash($id);
				mysqli_query($mysqli, "UPDATE urllist SET hash='$hash' WHERE id=$id");
			}
			
		}
		echo $hash;
	}

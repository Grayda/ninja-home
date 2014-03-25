<?php

	
	require("class/adodb_lite/adodb.inc.php"); // ADOdb Lite for our database needs. Makes porting to other database types easy too


	class cSQL {
	
		public $db;
		
		function __construct($host = "localhost", $username = "root", $password = "", $database = "ninjaDash", $type = "mysqli") { // Connects to our database when we create a new cSQL class
			$this->db = ADONewConnection($type);	
			$result = $this->db->PConnect($host, $username, $password, $database);
		}
		
		function doSQL($sql) { // Executes raw SQL. Used mainly to truncate the database (reset switch, basically)
			return $this->db->Execute($sql);
		}
		
		function dismiss($id) { // Adds the ID of an HTML element into our database, so they won't appear next time
			return $this->db->Execute("INSERT INTO dismissed VALUES ('" . $id . "')");	
		}
		
		function isDismissed($id) { // Find out if a notification has been dismissed or not.
			$res = 	$this->db->GetArray("SELECT * FROM dismissed WHERE id = '" . $id . "'");	
			if(!empty($res)) { return true; } else { return false; }
		}
		
		
	}
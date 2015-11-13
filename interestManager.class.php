<?php

class interestManager {
	
	//interestManager.class.php
	
	private $connection;
	// --saan kasutada muutujad classi ees
	

		
		//kui ütleb new siis siin saad kätte saada
		function __construct($mysqli){
			
			//selle klassi muutuja
			$this->connection = $mysqli;
			
			
		}
		
		function addinterest($new_inerest){
			
			
			
			
			//**************************************************************************
			
			/*$response = new StdClass();
			
			$stmt = $this->connection->prepare("INSERT INTO user_interests(user_id, interests_id) VALUES (?, ?)");
		    $stmt->bind_param("ss", $user_id, $interests_id);
			
			//kas selline huviala on juba olemas?
			$stmt = $this->connection->prepare("SELECT * FROM user_interests WHERE name = ?");
			$stmt->bind_param("s", $$new_inerests);
			$stmt->bind_result($user_id_from_db, $new_inerests);
			$stmt->execute();
			
			return $response;
				
			if($stmt->execute()){
			// edukalt salvestas
			$success = new StdClass();
			$success->message = "Huviala edukalt salvestatud";
			
			$new_inerest = new StdClass();
			$new_interest->$new_inerestst = $user_id_from_db;
			$new_interest->email = $interests_id_from_db;
			
			$success->interestManager = $interestManager;
			
			
			$response->success = $success;
			
			$stmt->close();
			return $response; */
			
			//***********************************************************************
			
			
			
			
		
		
			$response = new StdClass();
			
			// kas selline huviala on juba olemas
			$stmt = $this->connection->prepare("SELECT id FROM user_inerests WHERE name = ?");
			$stmt->bind_param("s", $create_email);
			$stmt->execute();
			
			
			if($stmt->fetch()){
				
				
				$error = new StdClass();
				$error->id = 0;
				$error->message = "Sellise huvialaga kasutaja juba olemas!";
				
				
				$response->error = $error;
				
				
				return $response;
				
			}
		
			
			$stmt->close();
		
			$stmt = $this->connection->prepare("INSERT INTO user_interests (name) VALUES (?)");
			$stmt->bind_param("ss", $new_inerests);
			
			if($stmt->execute()){
				// edukalt salvestas
				$success = new StdClass();
				$success->message = "Kasutaja edukalt salvestatud";
				
				$response->success = $success;
				
			}else{
				// midagi läks katki
				$error = new StdClass();
				$error->id =1;
				$error->message = "Midagi läks katki!";
				
				//panen errori responsile külge
				$response->error = $error;
			}
			
			$stmt->close();
			
			//saada tagasi vastuse, kas success või error
			return $response;
		
		}
	
	
	
	     function createDropdown(){
			
			
			$html = '';
			
			// punk liidab juurde
			$hmtl .='<select name="dropdownselect">';
			
			$stmt = $this->connection->prepare("SELECT name FROM user_interests")
			$stmt->bind_result($name);
			$stmt->execute;
			
			
			//iga rea kohjta teen midagi
			while($stmt->fetch()){
				
			   	$hmtl .= '<option>'.$name.'</option>';
				
			}
			
			$stmt->close;
			
			//$hmtl .= '<option value="2">Teisipäev</option>';
			
			$hmtl .='</select>';
			
			
			
			//$first_name =
			//$last_name =
			//$html = $first_name." ".$last_name;
			//$html =$first_name
			//$html = " "
			//$html =$last_name
			
			
			return $html;
			
		}
	
	
	
	
}?>







<?php
   //laeme funktsiooni failis
   require_once("function.php");
   require_once("interestManager.class.php");
   
   // kas kasutaja on sisse loginud
   if(!isset($_SESSION["id_from_db"])) {
	   //suudan data lehel
	   header("Location: login.php");
	   
	   exit();
	   
   }
   //login v�lja
   if(isset($_GET["logout"])){
	   // kustutab k�ik sessiooni muutujad
	   session_destroy();
	   
	   
	   header("Location: login.php");
	   
   }
   $inerestManager = new interestManager($mysqli);
   
   
   if(isset($GET["new_interest"])) {
	   
	   $added_interest= $interestManager->addinterest($_GET["new_interest"]);
	   
	   
   }
   
       
     if(isset($GET["dropdownselect"])) {
	   
	   //saadan valiku id ja kasutaja id
	   $added_interest= $interestManager->addinterest($_GET["dropdownselect"], $SESSION["id_from_db"]);
	   
	   
     }   
	   
		  //FILE UPLOAD
		  
	$target_dir = "portfile_pics/";
	//profile_pics/Koala.png
	$target_file = $target_dir . $_SESSION["id_from_db"].".jpg";

	  if(isset($_POST["submit"])) {
		   $uploadOk = 1;
		   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check if image file is a actual image or fake image  
	// getimagesize anna mulle selle pildi suurus
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
     if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
         $uploadOk = 0;
}
// Check file size
      if ($_FILES["fileToUpload"]["size"] > 1024000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
}
// Allow certain file formats
       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {    //v�ttab temp kaustast, kontrollime kas selline fail sobib, ja siis suunatakse meile failisse
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
  
  }  
?>

<p>
  Tere, <?php echo $_SESSION["user_email"];?>
  <a href= "?logout=1" >Logi v�lja</a>
</p>



<h2>Lisa uus huviala</h2>
<form>
     <input name="new_inerest">
	 <input type="submit">
</form>




<h2>Lisa uus huviala</h2>
 <?php if(isset($added_interest->error)): ?>
  
	<p style="color:red;">
		<?=$added_interest->error->message;?>
	</p>
  
  <?php elseif(isset($added_interest->success)): ?>
  
	<p style="color:green;">
		<?=$added_interest->success->message;?>
	</p>
  
  <?php endif; ?>  
<form>
	<input name="new_interest">
	<input type="submit">
</form>


<h2>Minu huvialad</h2>

<?php if(isset($added_user_interest->error)): ?>
  
	<p style="color:red;">
		<?=$added_user_interest->error->message;?>
	</p>
  
  <?php elseif(isset($added_user_interest->success)): ?>
  
	<p style="color:green;">
		<?=$added_user_interest->success->message;?>
	</p>
  
  <?php endif; ?>  
<form>
	<!-- SIIA TULEB RIPPMEN�� -->
	<?php echo $InterestManager->createDropdown();?>
	<input type="submit">
</form>



<p><?php echo $InterestManager->getUserinterests($_SESSION["id_from_db"]);?></p>













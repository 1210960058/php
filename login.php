<?php

session_start();
try{
$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}
$_SESSION["id"]=$_POST["id"];
$_SESSION["pass"]=$_POST["pass"];


$search=$pdo->prepare('select * from student WHERE id=:id');
$search ->bindParam(':id',$_SESSION["id"]);
$search ->execute();

$result = $search ->fetch(PDO::FETCH_ASSOC);

if ($_SESSION["pass"] == $result['pass']) {
	if (mb_substr($_SESSION["id"] ,0 ,1) == "t") {
		echo '<form method="post" action="teacher.php">';
	}
	else{echo '<form method="post" action="student.php">';}
	
?>

<p>
<select name="class">

<?php
foreach ($result as $key => $value){
	if ($key != id  && $key != pass) {
		echo "<option value=".$result[$key].">".$result[$key]."</option>";
	}

  
}
?>


</select>
</p>
<p><input type="submit" value="出席確認"></p>
</form>

<?php


	
}
else{
	echo "NO";
}

?>

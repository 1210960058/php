<?php
session_start();
try{

$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}
$_SESSION["class"]=$_POST["class"];
//echo $_SESSION["id"];
//echo $class;
$search=$pdo->prepare('select * from '.$_SESSION["class"].' WHERE id=:id ORDER BY time');
$search ->bindParam(':id',$_SESSION["id"]);
$search ->execute();
$_SESSION["result"] = $search ->fetchAll();

$search2=$pdo->prepare('select * from '.$_SESSION["class"].' WHERE id LIKE "%t%" ORDER BY time');
$search2 ->execute();
$_SESSION["teacher"] = $search2 ->fetchAll();


echo $_SESSION["result"][0]['id']."さんの出欠表";
echo '<br>';
echo "授業名「".$_SESSION["class"]."」";

for($i=0,$co=1;$i<16;$i++,$co++){
	if( empty($_SESSION["teacher"][$i]['id']) ){ break;}
	for ($j=0; $j < 16; $j++) { 
		if (empty($_SESSION["result"][$j]['id'])) {
			echo '<br>';
			echo $co.'回目 欠席';
			break;
		}
		if (date('Y/m/d',strtotime($_SESSION["teacher"][$i]['time'])) == date('Y/m/d',strtotime($_SESSION["result"][$j]['time']))){
			if (date('G:i:s',strtotime($_SESSION["teacher"][$i]['time'])) < date('G:i:s',strtotime($_SESSION["result"][$j]['time']))) {
					header('Content-type: text/html');
					echo '<br>';
					echo $co.'回目 遅刻';
					print($_SESSION["result"][$j]['time']);
					echo '<br>';
					echo '<img src="img.php?count='.$j.'&id='.$_SESSION["result"][0]['id'].'" />';
					break;
			}
			else{
					header('Content-type: text/html');
					echo '<br>';
					echo $co.'回目';
					print($_SESSION["result"][$j]['time']);
					echo '<br>';
					echo '<img src="img.php?count='.$j.'&id='.$_SESSION["result"][0]['id'].'" />';
					break;
			}
		}
	}



}
?>

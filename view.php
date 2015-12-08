<?php
try{
$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}
$search_key=$_POST["search_key"];


$search=$pdo->prepare('select * from class14 WHERE id='.$search_key);
$search ->execute();

$result = $search ->fetch(PDO::FETCH_ASSOC);

$contents_type = array(
'jpg' => 'image/jpeg',
'png' => 'image/png',
);




//header('Content-type: image/jpg');
//echo $result['img_col'];

header('Content-type: text/html');
echo '<br>';
print($result['id']);
echo '<br>';
print($result['time']);
echo '<br>';
echo '<img src="img.php?key='.$search_key.'" />';
//header('Content-type: image/jpg');
//echo $result['img_col'];


//$id=array(0,1,2,3);
//$contents_type = array(
//'jpg' => 'image/jpeg',
//'png' => 'image/png',
//);

//$img_dd='./test.jpg';
//$img=file_get_contents($img_dd);

//$stmt = $pdo -> prepare("SELECT id, img_col FROM test WHERE id=:id");
//$stmt ->bindParam(':id',$id);
//$stmt ->execute();
//$img = $stmt -> fetchObject();
//header('Content-type:' .$content_type[$img->id]);
//echo $img->img_col;
?>

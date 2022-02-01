<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        Select image to upload:
        <input type="file" name="uploadedName" class="form-control" accept="image/*, video/*, audio/*"/></br>
        <input type="submit" value="nahrát" name="submit"/>
    </div>
</form>

<?php
if ($_FILES){
    $targetDir="uploads/";
    $targetFile=$targetDir . basename($_FILES['uploadedName']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadSuccess = true;

    if($_FILES['uploadedName']['error'] !=0){
        echo "Chyba serveru při uploadu ";
        $uploadSuccess=false;
    }

    elseif(file_exists($targetFile)){
        echo "soubor již existuje ";
        $uploadSuccess=false;
    }

    elseif(($_FILES['uploadedName']['size']>8000000)){
        echo "Soubor je příliš velký ";
        $uploadSuccess=false;
    }

    if(!$uploadSuccess){

    }else{
        if(move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)){
            echo "Soubor '" . basename($_FILES['uploadedName']['name'] . "' byl uložen");
        }else{
            echo "Došlo k chybě uploadu ";
        }
    }

    if($fileType == "jpg" || $fileType == "png"){
        echo '</br><img src="uploads/'.basename($_FILES['uploadedName']['name']).'"';
    }elseif($fileType == "mpeg" || $fileType == "mp3" ){
        echo '</br><audio controls autoplay>
    <source src="uploads/'.basename($_FILES['uploadedName']['name']).'" type="audio/mpeg">
    </audio>';
    }elseif($fileType == "mp4" || $fileType == "avi" ){
        echo '</br><video controls autoplay>
    <source src="uploads/'.basename($_FILES['uploadedName']['name']).'" type="video/mp4">
    </video>';
    }
}
?>
</body>

</html>
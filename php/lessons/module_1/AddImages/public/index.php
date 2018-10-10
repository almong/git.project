<?php
include '../models/ImageFile.php';

if (!empty($_FILES)) {
    $image = new ImageFile($_FILES['file']);

//    echo $image->checkType();
//    echo $image->validationFile();

}
?>

<form method="post" enctype="multipart/form-data">
 <div>
      <input type="file" name="file">
 </div>
 <div>
   <button>Submit</button>
 </div>
</form>
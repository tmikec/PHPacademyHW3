<?php
define('MB', 1048576);
define('DS', DIRECTORY_SEPARATOR);

$Extensions = ['jpg', 'jpeg', 'png'];
$errors = [];

if (isset($_POST['upload']) && !empty($_FILES))
{
    $name = $_FILES['image']['name'];
    $path = __DIR__ . DS . $name;
    $size = $_FILES['image']['size'];
    $rawExt = $_FILES['image']['type'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $explodedExt = explode('/', $rawExt);
    $ext = end($explodedExt);

    if (!in_array($ext, $allowedExtensions))
    {
        $errors[] = "Slika mora biti idućeg formata: .jpg, .jpeg, .png";
    }
    if ($size > MB)
    {
        $errors[] = "Veličina slike mora biti manja od 1MB";
    }
    if (empty($errors))
    {
        if (move_uploaded_file($imageTmp, $path))
        {
            echo "Uspješno uploadano u '<b>'{$path}'</b>'";
        }
        else
        {
            $errors[] = "Pokušajte ponovo";
        }
    }
}
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button name="upload">Upload</button>

    <?php foreach ($errors as $error) : ?>
    <?= "<span><b>", "<br>", $error, "<br>", "</b></span>"; ?>
    <?php endforeach; ?>
</form>
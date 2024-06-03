<?php
$title = 'Inscription EasyTask';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'header.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'UsersController.php';

const LIMIT_USERNAME = 4;
const LIMIT_PASSWORD = 4;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if( !empty($_POST['username']) && !empty($_POST['password']) ) {

        $users = new UsersController();
        $success = null;

        //var_dump(dirname(__DIR__));
        if(isset($_FILES['photoProfile']) && $_FILES['photoProfile']['error'] === 0){
            $file = $_FILES['photoProfile'];

            $allowed = [
                    'jpeg'=>'image/jpeg',
                    'jpg'=>'image/jpg',
                    'png'=>'image/png'
            ];
            $filename = $file['name'];
            $filetype = $file['type'];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $name = pathinfo($filename, PATHINFO_FILENAME);

            #$name = pathinfo($filename);
            if(array_key_exists($extension,$allowed) || in_array($filetype,$allowed))
            {
                $destination = "/uploads";
                if(!is_dir(dirname(__DIR__)
                    .DIRECTORY_SEPARATOR.'config/'.$destination))
                {
                    mkdir(dirname(__DIR__)
                        .DIRECTORY_SEPARATOR.'config/'.$destination, recursive: true);
                }
                #$users=$sql->execute([$email,$passwd,$newName.'.'.$extension]);
                #$newfilename = __DIR__.DIRECTORY_SEPARATOR.''.$destination.DIRECTORY_SEPARATOR.$newName.'.'.$extension.'';

                $newfilename = dirname(__DIR__).DIRECTORY_SEPARATOR.'config/'.$destination.DIRECTORY_SEPARATOR.md5(uniqid()).'.'.$extension.' ';
                ##var_dump($newfilename);
                ##var_dump($file['tmp_name']);

                if (!move_uploaded_file($file['tmp_name'],$newfilename)){
                    echo '<script>alert("ton fichier n\'a pas été uploader")</script>';
                }
                }else{
                    echo '<script>alert("ton fichier de '.$name.'.'.$extension.' n\'est pas un image")</script>';
                }

        }else {
            echo 'Mettre une photo';
        }

        #if($users->isValid() !== false){
        if (strlen($_POST['username']) < LIMIT_USERNAME) {
            $errors['username'] = "Veuiller remplir un identifiant";
        }
        if (strlen($_POST['password']) < LIMIT_PASSWORD) {
            $errors['password'] = "Veuiller remplir un password";
        }
        if (!$_FILES['photoProfile'] && $_FILES['photoProfile']['error'] !== 0) {
            $errors['photoProfile'] = "Veuiller remplir un photo de profile";
        }
        if ($errors == []) {
            $users->addUsers($_POST['username'], $_POST['password'], md5(uniqid()).'.'.$extension);
            $success = "Votre compte a bien été créer";
            $_POST = [];
        } else {
            $errors;
        }

    }

}
?>

    <div class="container w-50 bg-light shadow rounded mt-5 p-5  ">
        <h1 class="text-center">Inscription</h1>
        <?php  if (isset($success)): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif ;?>

        <form method="POST" class="mt-5" enctype="multipart/form-data">

            <div class="form-group mb-2">
                <input
                    type="text"
                    name="username" class="form-control <?php if( isset($errors['username']) ){echo "is-invalid" ?? '';} ?>"
                    placeholder="Identifiant"
                    value="<?=htmlentities($_POST['username'] ?? '')?>"
                >
                <?php if (isset($errors['username'])): ?>
                    <div class="invalid-feedback">
                        <?= $errors['username'] ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="form-group mb-2">
                <input
                    type="password"
                    name="password"
                    class="form-control <?php if( isset($errors['password']) ){echo "is-invalid" ?? '';} ?>"
                    placeholder="Password"
                    value="<?=htmlentities($_POST['password'] ?? '')?>"
                    accept="*/*"
                >
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-2">
                <input
                    type="file"
                    name="photoProfile"
                    class="form-control <?php if( isset($errors['photoProfile']) ){echo "is-invalid" ?? '';} ?>"
                    placeholder="Photo Profile"
                    value="<?=htmlentities($_POST['photoProfile'] ?? '')?>"
                >
                <?php if (isset($errors['photoProfile'])): ?>
                    <div class="invalid-feedback">
                        <?= $errors['photoProfile'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-2">
                <input type="submit" value="Create" class="me-auto btn btn-primary" placeholder="Identifiant">
            </div>
            <div class="form-group mb-2">
                <p>Si vous avez déjà un compte <a href="login.php" class="text-decoration-none text-primary" >Connectez-vous</a></p>
            </div>
        </form>
    </div>




















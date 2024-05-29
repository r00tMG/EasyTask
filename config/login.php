<?php
$title = 'Login EasyTask';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'header.php';
require_once '../controller/UsersController.php';

const LIMIT_USERNAME = 4;
const LIMIT_PASSWORD = 4;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if( !empty($_POST['username']) && !empty($_POST['password']) ) {

        $users = new UsersController();
        $success = null;
        $error = null;
        $listUsers = $users->displayUsers();
        /*echo "<pre>";
        var_dump($listUsers[0]);*/
        $username = $_POST['username'];
        $password = $_POST['password'];
        for ($i=0;$i<count($listUsers);$i++){
            if( $listUsers[$i]['username']==$username && password_verify($password,$listUsers[$i]['password']) ){
                session_start();
                $_SESSION['users'] = [
                        'id_users'=>$listUsers[$i]['id'],
                        'username'=>$username,
                        'photoProfile'=>$listUsers[$i]['photoProfile']
                ];
                header('location:../index.php');
            }
        }


        if (strlen($_POST['username']) < LIMIT_USERNAME) {
            $errors['username'] = "Veuiller remplir un identifiant";
        }
        if (strlen($_POST['password']) < LIMIT_PASSWORD) {
            $errors['password'] = "Veuiller remplir un password";
        }

        if ($errors == []) {

        } else {
            $error = "Votre compte n'existe pas";
        }

    }

}

?>

<div class="container w-50 bg-light shadow rounded mt-5 p-5  ">
    <h1 class="text-center">Inscription</h1>
    <?php  if (isset($error)): ?>
        <div class="alert alert-success">
            <?= $error ?>
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
            >
            <?php if (isset($errors['password'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['password'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <input type="submit" value="Create" class="me-auto btn btn-primary" placeholder="Identifiant">
        </div>
        <div class="form-group mb-2">
            <p>Si vous n'avec pas encore un compte <a href="signup.php" class="text-decoration-none text-primary" >Inscrivez-vous</a></p>
        </div>
    </form>
</div>




















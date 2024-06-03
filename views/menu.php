<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'UsersController.php';
if(isset($_POST['logout'])){
    $user = new UsersController();
    $user->logout($_SESSION['users']) ;
}
$users = new UsersController();
$listUsers = $users->displayUsers();
#var_dump($listUsers);
?>
<nav class="navbar w-75 m-auto navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">EasyTask</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if( $_SERVER['SCRIPT_NAME']=="/index.php" || $_SERVER['SCRIPT_NAME']=="/" ){echo 'active';}?>" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <?php
                    if(isset($_SESSION['users']) && $_SESSION['users']['username']==='admin@gmail.com' ) :
                        ?>
                    <a class="nav-link <?php if( $_SERVER['SCRIPT_NAME']=="/views/admin.php"){echo 'active';}?>" href="/views/admin.php">Admin</a>
                    <?php
                    endif;
                    ?>
                </li>
                <li class="nav-item">
                    <?php if( empty($_SESSION['users']) ):?>
                    <a class="nav-link <?php if( $_SERVER['SCRIPT_NAME']=="../config/signup.php"){echo 'active';}?>" href="../config/signup.php">Signup</a>
                    <?php endif; ?>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>-->
            </ul>
            <ul class="navbar-nav  mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <form method="POST">
                        <button class="nav-link active btn btn-outline-dark text-light" type="submit" name="logout" >Logout</button>
                    </form>
                </li>
                <li class="nav-item mx-2">
                    <?php
                    if(isset($_SESSION['users']) && $_SESSION['users']['username']=='admin@gmail.com' ) :
                    ?>
                    <!-- Button trigger modal -->
                    <button  class="text-decoration-none btn btn-dark text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Your Task</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3 needs-validation" method="POST" novalidate>
                                        <div class="col-md-4">

                                            <label for="validationCustom01" class="form-label">By Admin :</label>
<!--                                            <input type="hidden" class="form-control" name="id_users" id="validationCustom01" value="<?php /*= htmlentities($_SESSION['users']['username']) */?>" required>
-->                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="validationCustom04" class="form-label">User</label>
                                            <select class="form-select" name="id_users" id="validationCustom04" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php   for($i=0;$i<count($listUsers);$i++): ?>
                                                <option><?= $listUsers[$i]['id'] ?></option>
                                                <?php endfor; ?>

                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid state.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom02" class="form-label">Description</label>
                                            <textarea type="text" class="form-control" name="description" id="validationCustom02"  required></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom04" class="form-label">Category</label>
                                            <select class="form-select" name="category" id="validationCustom04" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid state.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom04" class="form-label">Priority</label>
                                            <select class="form-select" name="priority" id="validationCustom04" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option>Important</option>
                                                <option>Peu important</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid state.
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="validationCustom04" class="form-label">Status</label>
                                            <select class="form-select" name="statut" id="validationCustom04" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option>Complete</option>
                                                <option>Incomplète</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid state.
                                            </div>
                                        </div>
                                        <!--<div class="col-md-3">
                                            <label for="validationCustom05" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="validationCustom05" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid zip.
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                                <label class="form-check-label" for="invalidCheck">
                                                    Agree to terms and conditions
                                                </label>
                                                <div class="invalid-feedback">
                                                    You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="col-12">
                                            <button class="btn btn-primary" name="createTask" type="submit">Create</button>
                                        </div>
                                    </form>
                                    <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>
                </li>
            </ul>

        </div>
    </div>
</nav>







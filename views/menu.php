<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'UsersController.php';
if(isset($_POST['logout'])){
    $user = new UsersController();
    $user->logout($_SESSION['users']) ;
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">EasyTask</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <!-- Button trigger modal -->
                    <button  class="text-decoration-none btn btn-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Admin
                    </button>

                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Your Task</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container rounded shadow m-auto p-5 mt-5 ">
                                        <h2 class="text-center text-secondary text-xxs font-weight-bolder opacity-7"> Liste des tâches </h2>
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table table-bordered align-items-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="4">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php for ($i=0;$i<count([]);$i++): ?>

                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <!--<div>
                                                                        <img src="uploads/'.$_SESSION['users']['photoProfile'].'" width="50px" height="50px" class="rounded-circle avatar avatar-sm me-3">
                                                                    </div>-->
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-xs"><?=[$i]['id_users']?></h6>
                                                                        <!--<p class="text-xs text-secondary mb-0">john@creative-tim.com</p>-->
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <p class="text-xs text-center font-weight-bold mb-0"><?= [$i]['description'] ;?></p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs text-center font-weight-bold mb-0"><?= [$i]['category'] ;?></p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs text-center font-weight-bold mb-0"><?= [$i]['priority'] ;?></p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs text-center font-weight-bold mb-0"><?= [$i]['statut'] ;?></p>
                                                            </td>
                                                            <td>

                                                                <form class="text-center" method="POST">
                                                                    <input type="hidden" name="idTask" value="<?=[$i]['idTask']?>">
                                                                    <button class="btn btn-transparent" name="delete">
                                                                        <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                                                             viewBox="0 0 1024 1024" height="1em" width="1em"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                                                            <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-transparent">
                                                                    <a href="views/edit.php?id=<?=[$i]['idTask']?>">
                                                                        <svg stroke="currentColor" class="text-success" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M7,17.013l4.413-0.015l9.632-9.54c0.378-0.378,0.586-0.88,0.586-1.414s-0.208-1.036-0.586-1.414l-1.586-1.586	c-0.756-0.756-2.075-0.752-2.825-0.003L7,12.583V17.013z M18.045,4.458l1.589,1.583l-1.597,1.582l-1.586-1.585L18.045,4.458z M9,13.417l6.03-5.973l1.586,1.586l-6.029,5.971L9,15.006V13.417z"></path><path d="M5,21h14c1.103,0,2-0.897,2-2v-8.668l-2,2V19H8.158c-0.026,0-0.053,0.01-0.079,0.01c-0.033,0-0.066-0.009-0.1-0.01H5V5	h6.847l2-2H5C3.897,3,3,3.897,3,5v14C3,20.103,3.897,21,5,21z"></path></svg>
                                                                    </a>
                                                                </button>

                                                            </td>

                                                        </tr>
                                                    <?php endfor;?>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../config/signup.php">Signup</a>
                </li>

                <li class="nav-item">

                    <form method="POST">
                    <button class="nav-link" type="submit" name="logout" >Logout</button>
                    </form>
                </li>
                <li class="nav-item">
                    <!-- Button trigger modal -->
                    <button  class="text-decoration-none btn btn-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

                                            <label for="validationCustom01" class="form-label">Author: <?= htmlentities($_SESSION['users']['username']) ?></label>
                                            <input type="hidden" class="form-control" name="id_users" id="validationCustom01" value="<?= htmlentities($_SESSION['users']['id_users']) ?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom02" class="form-label">Description</label>
                                            <input type="text" class="form-control" name="description" id="validationCustom02" value="Otto" required>
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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>







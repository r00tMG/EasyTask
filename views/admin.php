<?php
$title = "Admin EasyTask";
require_once '../controller/UsersController.php';
require_once 'header.php';
require_once 'menu.php';

$users = new UsersController();
$listUsers = $users->displayUsers();
#echo "<pre>";
#var_dump($listUsers);
?>


<div class="container rounded shadow m-auto p-5 mt-5 ">
    <h2 class="text-center text-secondary text-xxs font-weight-bolder opacity-7"> Liste des Utilisateurs </h2>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered align-items-center mb-0">
                <thead>
                <tr>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Photo Profile</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="4">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0;$i<count($listUsers);$i++): ?>
                    <tr>
                        <!--<td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                   <img src="uploads/'.$_SESSION['users']['photoProfile'].'" width="50px" height="50px" class="rounded-circle avatar avatar-sm me-3">
                               </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs"</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                </div>
                            </div>
                        </td>-->
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listUsers[$i]['username'] ;?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listUsers[$i]['password'] ;?></p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0"><?= $listUsers[$i]['photoProfile'] ;?></p>
                        </td>

                        <td>
                            <?php
                                if (isset($_POST['deleteUser'])){
                                    $users->deleteUser($_POST['idUser']);
                                }
                            ?>
                            <form class="text-center" method="POST">
                                <input type="hidden" name="idUser" value="<?=$listUsers[$i]['id']?>">
                                <button class="btn btn-transparent" name="deleteUser">
                                    <svg stroke="currentColor" class="text-danger" fill="currentColor" stroke-width="0"
                                         viewBox="0 0 1024 1024" height="1em" width="1em"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M292.7 840h438.6l24.2-512h-487z"></path>
                                        <path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-504-72h304v72H360v-72zm371.3 656H292.7l-24.2-512h487l-24.2 512z"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endfor;?>
                </tbody>
            </table>
        </div>
    </div>
</div>


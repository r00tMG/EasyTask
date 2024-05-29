<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'TasksController.php';
session_start();

    $task = new TasksController();
    $taskById = $task->getTaskById($_GET['id']);
var_dump($taskById);

if( isset($_GET['id']) && isset($_POST['updateTask']) ){
    var_dump($_GET['id']);

        var_dump($taskById);
        ##$description,$category,$priority,$statut,$id_users,$id;
       $var = $task->update($_POST['description'],$_POST['category'],$_POST['priority'],$_POST['statut'],$_POST['id_users'],$_POST['idTask']);
       header('Location:../index.php');
       exit(0);
}
require_once 'header.php';
require_once 'menu.php';
?>

<div class="container mt-5 rounded shadow p-5 m-auto w-75">

    <form class="row g-3 needs-validation" method="POST" novalidate>
        <h1 class="text-center">Update your task</h1>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Author: </label>
            <input type="hidden" class="form-control" name="id_users" id="validationCustom01" value="<?= htmlentities($taskById['id_users'])?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <input type="hidden" class="form-control" name="idTask" id="validationCustom02" value="<?= htmlentities($_GET['id'])?>" required>

        </div>
        <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="validationCustom02" value="<?= htmlentities($taskById['description'])?>" required>
        </div>
        <div class="col-md-4">
            <label for="validationCustom04" class="form-label">Category</label>
            <select class="form-select" name="category"  id="validationCustom04" required>
                <option selected  value="<?= htmlentities($taskById['category'])?>"><?= htmlentities($taskById['category'])?></option>
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
                <option selected  value="<?= htmlentities($taskById['priority'])?>"><?= htmlentities($taskById['priority'])?></option>
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
                <option selected  value="<?= htmlentities($taskById['statut'])?>"><?= htmlentities($taskById['statut'])?></option>
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
            <button class="btn btn-primary" name="updateTask" type="submit">Update</button>
        </div>
    </form>
</div>
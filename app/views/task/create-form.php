<?php include('../app/views/common/form-errors.php'); ?>
<?php include('../app/views/common/success-alert.php'); ?>
<form method="POST" action="/task">
    <?=csrfField()?>
    <div class="form-row form-group">
        <div class="col-6">
            <label>Your name</label>
            <input type="text" class="form-control form-control-sm" name="username" placeholder="Enter your name">
        </div>
        <div class="col-6">
            <label>E-mail</label>
            <input type="text" class="form-control form-control-sm" name="mail" placeholder="Enter your e-mail address">
        </div>
    </div>
    <div class="form-row">
        <div class="col-9">
            <input type="text" class="form-control form-control-sm" name="text" placeholder="Enter task text">
        </div>
        <div class="col-3">
            <input type="submit" class="form-control form-control-sm btn-primary" value="+ Create task">
        </div>
    </div>
</form>
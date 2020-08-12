<div class="bg-white shadow-sm mx-auto p-5 mb-5" style="border-radius: 25px; max-width: 400px">
    <?php include('../app/views/common/form-errors.php'); ?>
    <form method="POST" action="/auth">
        <?=csrfField()?>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control form-control-sm" name="username" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control form-control-sm" name="password" placeholder="Enter task text">
        </div>
        <div class="form-group">
                <input type="submit" class="form-control form-control-sm btn-primary" value="Log in">
        </div>
    </form>
</div>
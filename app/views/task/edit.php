<div class="bg-white shadow-sm mx-auto p-5 mb-4" style="border-radius: 25px; max-width: 700px">
    <?php include('../app/views/common/form-errors.php'); ?>
    <?php include('../app/views/common/success-alert.php'); ?>
    <form method="POST" action="/task/edit">
        <?=csrfField()?>
        <input type="hidden" name="id" value= <?= $task['id'] ?>>
        <div class="form-row form-group">
            <div class="col-6">
                <label>Your name</label>
                <input type="text" value="<?= $task['author'] ?>" class="form-control form-control-sm" name="username"
                       placeholder="Enter your name">
            </div>
            <div class="col-6">
                <label>E-mail</label>
                <input type="text" value="<?= $task['mail'] ?>" class="form-control form-control-sm" name="mail"
                       placeholder="Enter your e-mail address">
            </div>
        </div>
        <div class="form-row">
            <div class="col-9">
                <input type="text" value="<?= $task['text'] ?>" class="form-control form-control-sm" name="text"
                       placeholder="Enter task text">
            </div>
            <div class="col-1">
                <input type="checkbox" name='completed'
                       class="form-control form-control-sm btn-primary" <?= $task['completed'] == 1 ? 'checked' : ''; ?>
                       value="<?= $task['completed'] == 1; ?>">
            </div>
            <div class="col-2">
                <input type="submit" class="form-control form-control-sm btn-primary" value="Update task">
            </div>
        </div>
    </form>
</div>
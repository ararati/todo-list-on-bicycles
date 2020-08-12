<div class="bg-white shadow-sm mx-auto p-5 mb-4" style="border-radius: 25px; max-width: 700px">
    <?php include('create-form.php') ?>
</div>

<div class="bg-white shadow-sm mx-auto p-2 mb-4" style="border-radius: 25px; max-width: 700px">
    <form method="GET" action="/" class="mb-0">
        <div class="form-row">
            <div class="col-5">
                <select name = 'field' class="custom-select custom-select-sm" style="border: none; border-right: #e0e0e0 1px solid; outline: none; border-radius: 0px; ">
                    <option <?=request()->get('field') === 'author' ? 'selected' : ''?> value="author">Name</option>
                    <option <?=request()->get('field') === 'mail' ? 'selected' : ''?>  value="mail">Mail</option>
                    <option  <?=request()->get('field') === 'id' ? 'selected' : ''?> value="id">Date</option>
                    <option  <?=request()->get('field') === 'completed' ? 'selected' : ''?> value="completed">Completed</option>
                </select>
            </div>

            <div class="col-4">
                <select name = 'by' class="custom-select custom-select-sm" style="border: none; border-right: #e0e0e0 1px solid; outline: none; border-radius: 0px;">
                    <option  <?=request()->get('by') === 'asc' ? 'selected' : ''?>  value="asc">Ascending</option>
                    <option  <?=request()->get('by') === 'desc' ? 'selected' : ''?>  value="desc">Descending</option>
                </select>
            </div>
            <input type = "hidden" name = 'page' value="<?=request()->get('page')?>">
            <div class="col-3">
                <button type = "submit" class="btn btn-outline-primary btn-block btn-sm" style="border-radius: 25px">Filter</button>
            </div>
        </div>
</div>
</form>

<?php include('list.php') ?>

<?php include('../app/views/common/pagination.php'); ?>
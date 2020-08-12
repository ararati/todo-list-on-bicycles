<?php if(request()->has('successAlert')) { ?>
    <div class = "alert alert-success">
        <?= s(request()->get('successAlert')) ?>
    </div>
<?php } ?>
<?php if(request()->has('error')) { ?>
<div class = "alert alert-danger">
    <?= s(request()->get('error')) ?>
</div>
<?php } ?>
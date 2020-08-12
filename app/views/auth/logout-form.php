<form action="/logout" method="POST">
    <?=csrfField()?>
    <input type="submit" class="btn btn-outline-secondary btn-sm" value="Log out">
</form>
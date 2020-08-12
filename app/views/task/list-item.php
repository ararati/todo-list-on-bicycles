<div class="bg-white shadow-sm mx-auto p-5 mb-4" style="border-radius: 25px; max-width: 700px">
    <?php if(isAuth()) {?>
    <a style="float: right; border-radius: 25px" href="/task/edit/<?=$task['id'];?>" class = "btn btn-sm btn-outline-primary">Edit</a>
    <?php }?>
    <blockquote class="blockquote">
        <p class="mb-0">
            <span style="text-decoration: <?=$task['completed'] ? 'line-through' : ''?>">
                <?= $task['text'] ?>
            </span><?= $task['changed'] == 1 ? '<cite class="text-muted"><small>(edited by admin)</small></cite>' : ''?></p>
        <footer class="blockquote-footer text-right"><?= $task['author'] ?> <cite
                title="Source Title"><?= $task['mail'] ?></cite></footer>
    </blockquote>
</div>
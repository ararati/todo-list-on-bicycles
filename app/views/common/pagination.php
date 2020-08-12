<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center pagination-lg">
        <?php if ($pagination && $pagination['count'] > 1) {
            for ($i = 1; $i <= $pagination['count']; $i++) { ?>
                <li class="page-item <?
                if (!request()->has('page') && $i === 1)
                    echo 'active';
                else echo request()->get('page') == $i ? 'active' : ''
                ?>">
                    <a class="page-link" href= <?= buildQuery([
                        'page' => $i,
                        'field' => request()->get('field'),
                        'by' => request()->get('by')
                    ]) ?>>
                        <?= $i ?>
                    </a>
                </li>
            <?php }
        } ?>
    </ul>
</nav>
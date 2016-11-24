<? $filename = pathinfo( $_SERVER['PHP_SELF'] )['filename']; ?>


<div class="container" style="margin-top: 20px">
<div class="row col-md-12">
    <ul class="nav nav-tabs">
        <li role="presentation" <?= $filename == 'index' ? 'class="active"' : ''?>>
            <a href="index.php">Missing concepts</a>
        </li>
        <li role="presentation" <?= $filename == 'add_info' ? 'class="active"' : ''?>>
            <a href="add_info.php">Missing info</a>
        </li>
        <li role="presentation" <?= $filename == 'all_concepts' ? 'class="active"' : ''?>>
            <a href="all_concepts.php">All concepts</a>
        </li>
    </ul>
</div>
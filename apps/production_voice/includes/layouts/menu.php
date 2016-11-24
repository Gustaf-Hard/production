<? $filename = pathinfo( $_SERVER['PHP_SELF'] )['filename']; ?>


<div class="container" style="margin-top: 20px">
<div class="row col-md-12">
    <ul class="nav nav-tabs">
        <li role="presentation" <?= $filename == 'index' ? 'class="active"' : ''?>>
            <a href="index.php">Voice dashboard</a>
        </li>
        <li role="presentation" <?= $filename == 'sv_voice' ? 'class="active"' : ''?>>
            <a href="sv_voice.php">Swedish voice</a>
        </li>
        <li role="presentation" <?= $filename == 'en_voice' ? 'class="active"' : ''?>>
            <a href="en_voice.php">English voice</a>
        </li>
    </ul>
</div>
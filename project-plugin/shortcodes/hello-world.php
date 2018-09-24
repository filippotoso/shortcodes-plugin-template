<?php error_reporting(E_ALL); ini_set('display_errors', 1); ?>
<p>Hello World!</p>

<?php if (!empty($attributes['name'])) : ?>
    <p>My name is <?= $attributes['name']; ?></p>
<?php endif; ?>

<?php if (!empty($attributes['name'])) : ?>
    <i>The content is: <?= $content; ?></i>
<?php endif; ?>

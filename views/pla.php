<?php
$width = !empty($config['width']) ? $config['width'] : '100%';
$height = !empty($config['height']) ? $config['height'] : 'calc(100vh - 95px - 2rem)'; // viewport height - sticky header - body-padding-bottom
?>

<iframe class="uk-responsive-width" width="{{ $width }}" height="{{ $height }}" scrolling="yes" frameborder="no" src="@route('phpliteadmin/pla')"></iframe>

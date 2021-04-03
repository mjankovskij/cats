<?php
echo 'Cats:';
foreach ($data['cats'] as $key => $cat) {
    echo $cat;
    if ($key != count($data['cats']) - 1) echo ', ';
}

echo "<p>Page $data[N] visited <b>$data[countN]</b> times.</p>
Total visitors <b>$data[countAll]</b>.</p>
<a href='./'>Back to our site</a>";
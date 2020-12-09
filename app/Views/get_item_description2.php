<?php
// var_dump($items);
helper('form');

echo form_open('home/getItemDescription');
echo "<div class='col-md-offset-4'>";
    $select = [
        'class'=>'col-md-2',
        'style'=>'color:green;margin:5px;'
    ];
    echo form_dropdown('itemid', $items, null, $select);
    echo form_submit([
        'name'=>'send',
        'value'=>'OK',
        'class'=>'btn btn-sm btn-success col-sm-2'
    ]);
    echo "</div>";
echo form_close();

<?php
helper('form');
$this->extend('default');

$this->section('content');
echo "<div style='color: red'>";
    if (isset($validation)) {
        // var_dump($validation->getErrors());
        echo $validation->listErrors();
    }
echo "</div>";
if (isset($success)) {
    echo "<div style='color: green'>$success</div>";
}
$st['class'] = 'form-horizontal';
echo form_open('home/registration', $st);
echo '<div class="row " style="margin:2px;">';
echo form_label('Enter your login: ', 'login',
    array('class' => 'control-label col-md-3'));
$data = array('name' => 'login', 'size' => '50',
    'class' => '');
echo form_input($data);
echo '</div>';
echo '<div class="row " style="margin:2px;">';
echo form_label('Enter password: ', 'pass1',
    array('class' => 'control-label col-md-3'));
$data = array('name' => 'pass1', 'size' => '50',
    'class' => '');
echo form_password($data);
echo '</div>';
echo '<div class="row " style="margin:2px;">';
echo form_label('Confirm password: ', 'pass2',
    array('class' => 'control-label col-md-3'));
$data = array('name' => 'pass2', 'size' =>
    '50', 'class' => '');
echo form_password($data);
echo '</div>';
echo '<div class="row 1" style="margin:2px;">';
echo form_label('Enter email: ', 'email',
    array('class' => 'control-label col-md-3'));
$data = array('name' => 'email', 'type' =>
    'email', 'size' => '50', 'class' => '');
echo form_input($data);
echo '</div>';
echo '<div class="row" style="margin:2px;">';
echo form_submit(array('name' => 'send', 'value' => 'Send',
    'class' => 'btn btn-success col-md-offset-4'));
echo form_reset(array('name' => 'reset', 'value' => 'Reset',
    'class' => 'btn btn-info'));
echo '</div>';
echo form_close();
$this->endSection();
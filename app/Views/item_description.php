<?= $this->extend('default') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class='col-md-offset-1'>
        <h2><?= $title?></h2>
        <h3><?= $item['name']?></h3>
        <p><?= $item['price']?></p>
        <p style='color:red;font-size:14pt;font-family:Verdana;'><?= $item['price_sale']?></p>
        <p><?= $item['description']?></p>
    </div>
</div>
<?= $this->endSection() ?>
<div class="row">
    <div class="col-md-4">
        <?= component('profile-card',['user'=>$user]) ?>
    </div>
    <div class="col-md-8">
    <div class="mb-2">
            <?php if (session()->hasFlash('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlash('success') ?></div>
            <?php endif ?>
            <?php if (session()->hasFlash('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlash('error') ?></div>
            <?php endif ?>
        </div>
    </div>
</div>
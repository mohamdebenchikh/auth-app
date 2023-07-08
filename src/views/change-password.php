<div class="row">
    <div class="col-md-4">
        <?= component('profile-card', ['user' => $user]) ?>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/profile/edit') ?>">Profile Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Change Password</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <form action="<?= url('/change-password/update') ?>" method="post" enctype="multipart/form-data">



                    <?= component('input', [
                        'name' => 'old_password',
                        'id' => 'old_password',
                        'label' => 'Current password',
                        'type' => 'password',
                        'error' => error('old_password')
                    ]) ?>

                    <?= component('input', [
                        'name' => 'password',
                        'id' => 'password',
                        'label' => 'New password',
                        'type' => 'password',
                        'error' => error('password')
                    ]) ?>

                    <?= component('input', [
                        'name' => 'password_confirmation',
                        'id' => 'password_confirmation',
                        'label' => 'Confirm new password',
                        'type' => 'password',
                        'error' => error('password_confirmation')
                    ]) ?>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
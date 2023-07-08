<div class="row">
    <div class="col-md-4">
        <?= component('profile-card', ['user' => $user]) ?>
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
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profile Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/change-password') ?>">Change Password</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <form action="<?= url('/profile/update') ?>" method="post" enctype="multipart/form-data">
                    <?= component('input', [
                        'name' => 'photo',
                        'id' => 'photo',
                        'type' => 'file',
                        'label' => 'Profile photo',
                        'error' => error('photo')
                    ]) ?>
                    <?= component('input', [
                        'name' => 'cover',
                        'id' => 'cover',
                        'type' => 'file',
                        'label' => 'Profile cover',
                        'error' => error('cover')
                    ]) ?>
                    <?= component('input', [
                        'name' => 'name',
                        'id' => 'name',
                        'label' => 'Your name',
                        'value' => old('name') ?? $user->name,
                        'error' => error('name')
                    ]) ?>

                    <?= component('textarea', [
                        'name' => 'bio',
                        'id' => 'bio',
                        'label' => 'Bio',
                        'value' => old('bio') ?? $user->bio,
                        'error' => error('bio'),
                        'placeholder' => 'How to describe yourself'
                    ]) ?>

                    <?= component('input', [
                        'name' => 'email',
                        'id' => 'email',
                        'label' => 'Email address',
                        'type' => 'email',
                        'value' => old('email') ?? $user->email,
                        'error' => error('email')
                    ]) ?>

                    <?= component('input', [
                        'name' => 'phone',
                        'id' => 'phone',
                        'type' => 'tel',
                        'label' => 'Phone Number',
                        'value' => old('phone') ?? $user->phone,
                        'error' => error('phone')
                    ]) ?>

                    <?= component('input', [
                        'name' => 'birthday',
                        'id' => 'birthday',
                        'type' => 'date',
                        'label' => 'Your Birthday',
                        'value' => old('birthday') ?? $user->birthday,
                        'error' => error('birthday')
                    ]) ?>
                    <?= component('select', [
                        'name' => 'gender',
                        'id' => 'gender',
                        'label' => 'gender',
                        'options' => [
                            ['label' => 'Male', 'value' => 'male'],
                            ['label' => 'Female', 'value' => 'female'],
                        ],
                        'value' => old('gender') ?? $user->gender,
                        'error' => error('gender')
                    ]) ?>
                    <?= component('input', [
                        'name' => 'location',
                        'id' => 'location',
                        'label' => 'Location',
                        'value' => old('location') ?? $user->location,
                        'error' => error('location')
                    ]) ?>
                    <?= component('input', [
                        'name' => 'job_title',
                        'id' => 'job_title',
                        'label' => 'Job title',
                        'value' => old('job_title') ?? $user->job_title,
                        'error' => error('job_title')
                    ]) ?>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save Change</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
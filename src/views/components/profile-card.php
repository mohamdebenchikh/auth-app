<div class="card" style="overflow: hidden;">
    <div style="height: 200px;background-position: center;background-size: cover;background-image: url(<?= $user->cover ?? url('/images/default-cover.jpg')  ?>);">
        <div class="d-flex flex-column align-items-center justify-content-center h-100" style="background-color: rgba(0, 0, 0, .5);">
            <img src="<?= $user->photo ?? url('/images/avatar-default.png') ?>" class="rounded-circle" width="120" height="120" style="border: solid 2px #999;object-fit:cover" alt="Profile Photo">
            <h3 class="mt-1 text-white"><?= $user->name ?></h3>
        </div>

    </div>
    <div class="card-body">
        <?php if ($user->bio) : ?>
            <h4>About Me</h4>
            <p><?= $user->bio ?></p>
            <hr>
        <?php endif ?>

        <ul class="list-unstyled">
            <?php if ($user->location) : ?>
                <li class="mb-2"><strong>Location:</strong> <?= $user->location ?></li>

            <?php endif ?>

            <?php if ($user->job_title) : ?>
                <li class="mb-2"><strong>Job title:</strong> <?= $user->job_title ?></li>
            <?php endif ?>

            <?php if ($user->birthday) : ?>
                <li class="mb-2"><strong>Birthday:</strong> <?= formatDate($user->birthday); ?></li>
            <?php endif ?>
            <?php if ($user->created_at) : ?>
                <li class="mb-2"><strong>Join at:</strong> <?= formatDate($user->created_at); ?></li>
            <?php endif ?>
        </ul>
        <div>
            <a href="<?= url('/profile/edit') ?>" class="btn btn-primary w-100">Edit Profile</a>
        </div>
    </div>
</div>
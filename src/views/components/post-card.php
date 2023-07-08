<div class="card mb-2">
    <div class="card-header">
        <div class="d-flex">
            <div class="me-2">
                <img class="rounded-circle" width="45" height="45" style="object-fit: cover;border:2px solid #999" src="<?= $post->user_photo ?? url('/images/avatar-default.png') ?>" alt="">
            </div>
            <div class="d-flex flex-column h-100 my-auto">
                <strong><?= $post->user_name ?></strong>
                <small class="text-muted"><?= timeAgo($post->created_at); ?></small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p><?= $post->text ?></p>
    </div>
</div>
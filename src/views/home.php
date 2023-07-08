<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <form action="<?= url('/posts') ?>" method="post">
                    <?= component('textarea', [
                        'name' => 'text',
                        'value' => old('text'),
                        'placeholder' => 'What is round in your mind?',
                        'error' => error('text')
                    ]) ?>
                    <div class="text-end">
                        <button class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($posts) : ?>
            <?php foreach ($posts['data'] as $post) : ?>
                <?= component('post-card',['post'=>$post]) ?>
            <?php endforeach ?>
            <?= component('pagination', ['pagination' => $posts['pagination']]) ?>
        <?php endif ?>
    </div>
</div>
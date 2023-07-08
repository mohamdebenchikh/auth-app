<div class="row py-5 justify-content-center">
    <div class="card" style="max-width: 450px;">
        <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form method="post" action="<?= url('/register') ?>">
                <?= component('input', [
                    'label' => 'Name',
                    'id' => 'name',
                    'name' => 'name',
                    'error' => error('name'),
                    'value' => old('name')
                ]) ?>
                <?= component('input', [
                    'type' => 'email',
                    'label' => 'E-mail',
                    'id' => 'email',
                    'name' => 'email',
                    'error' => error('email'),
                    'value' => old('email')
                ]) ?>
                <?= component('input', [
                    'type' => 'password',
                    'label' => 'Password',
                    'id' => 'password',
                    'name' => 'password',
                    'error' => error('password'),
                ]) ?>
                <?= component('input', [
                    'type' => 'password',
                    'label' => 'Confirm Password',
                    'id' => 'password_confirmation',
                    'name' => 'password_confirmation',
                    'error' => error('password_confirmation'),
                ]) ?>
                <button type="submit" class="btn btn-primary btn-block">Register</button>

            </form>
        </div>
    </div>
</div>
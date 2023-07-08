<div class="row py-5 justify-content-center">
    <div class="card" style="max-width: 450px;">
        <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form method="post" action="<?= url('/login') ?>">
                <?= component('input', [
                    'type' => 'email',
                    'label' => 'E-mail',
                    'id' => 'email',
                    'name' => 'email',
                    'error'=> error('email'),
                    'value' => old('email')
                ]) ?>
                <?= component('input', [
                    'type' => 'password',
                    'label' => 'Password',
                    'id' => 'password',
                    'name' => 'password',
                    'error'=> error('password'),
                    'value' => old('password')
                ]) ?>
                <?= component('checkbox',[
                    'id'=>'remember',
                    'name' => 'remember',
                    'label' => 'Remember me',
                    'value' => true
                ]) ?>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                
            </form>
        </div>
    </div>
</div>
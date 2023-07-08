<div class="mb-3">
    <?php if (isset($label)) : ?>
        <label class="form-label" for="<?= $id ?? '' ?>"><?= $label ?></label>
    <?php endif ?>
    <input type="<?= $type ?? 'text' ?>" value="<?= $value ?? '' ?>" class="form-control <?= isset($error) && !empty($error) ? 'is-invalid' : '' ?> <?= $class ?? '' ?>" name="<?= $name ?? '' ?>" id="<?= $id ?? '' ?>" placeholder="<?= $placeholder ?? '' ?>">
    <?php if (isset($error)) : ?>
        <div class="invalid-feedback">
            <?= $error ?>
        </div>
    <?php endif ?>
</div>
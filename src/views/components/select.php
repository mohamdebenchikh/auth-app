<div class="mb-3">
    <?php if (isset($label)) : ?>
        <label class="form-label" for="<?= $id ?? '' ?>"><?= $label ?></label>
    <?php endif ?>
    <select class="form-control <?= isset($error) && !empty($error) ? 'is-invalid' : '' ?> <?= $class ?? '' ?>" name="<?= $name ?? '' ?>" id="<?= $id ?? '' ?>">
        <option value="">------------------------------</option>    
    <?php if (isset($options)) : ?>
            <?php foreach ($options as $option) : ?>
                <?php if (is_array($option)) : ?>
                    <option <?= isset($value) && $value === $option['value'] ? 'selected' : '' ?> value="<?= $option['value'] ?>"><?= $option['label'] ?></option>
                <?php else : ?>
                    <option <?= isset($value) && $value === $option ? 'selected' : '' ?> value="<?= $option ?>"><?= $option ?></option>
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>
    </select>
    <?php if (isset($error)) : ?>
        <div class="invalid-feedback">
            <?= $error ?>
        </div>
    <?php endif ?>
</div>
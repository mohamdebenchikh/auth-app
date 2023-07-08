 <div class="mb-3">
     <div class="form-check">
         <input class="form-check-input" value="<?= $value ?? '' ?>" type="checkbox" id="<?= $id ?? '' ?>" name="<?= $name ?? '' ?>" <?= isset($checked) && $checked ? 'checked' : '' ?>>
         <?php if (isset($label)) : ?>
             <label class="form-check-label" for="<?= $id ?? '' ?>">
                 <?= $label ?>
             </label>
         <?php endif ?>
     </div>
 </div>
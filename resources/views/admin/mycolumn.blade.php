<div class="my-div-outer">
    <div class="my-div-inner">
        <?php
            $decrypted = $model->decryptPassword($model->password);
        ?>
        <div class="form-group form-element-text ">
            <label for="password" class="control-label">
                Пароль
                <span class="form-element-required">*</span>
            </label>
            <input class="form-control" type="text" id="password" name="password" value="<?=$decrypted?>">

        </div>
    </div>
</div>
<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title					=	'Login';
	$this->params['breadcrumbs'][]	=	$this->title;
?>
<div class="site-login">
    <h1><?php echo Html::encode($this->title)?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php echo $form->field($model, 'username')?>
    <?php echo $form->field($model, 'password')->passwordInput()?>

    <?php echo $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox()?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
        </div>
    </div>

    <?php ActiveForm::end()?>
	<?php
		/*
		    <div class="col-lg-offset-1" style="color:#999;">
		        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
		        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
		    </div>
    	*/
	?>
</div>

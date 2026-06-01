<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'user_id')->textInput() ?>
<!---->
    <?= $form->field($model, 'course_name')->dropDownList([
        'oaip' => 'Основы алгоритмизации и программирование',
        'owd' => 'Основы веб-дизайна',
        'opbd' => 'Основы проектирования баз данных', ], ['prompt' => 'Выберите курс']) ?>

    <?= $form->field($model, 'start_date')->input('date', [
        'min' => date('Y-m-d'),
        'max' => date('2030-12-31'),
    ]) ?>

    <?= $form->field($model, 'payment_id')->dropDownList([
        1 => 'Наличными',
        2 => 'Переводом по номеру телефона'
    ], ['prompt' => 'Выберите способ оплаты']) ?>

<!--    --><?php //= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'in_progress' => 'In progress', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

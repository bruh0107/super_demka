<?php

use app\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row g-4'],
            'itemOptions' => ['class' => 'col-md-4'],
            'itemView' => function ($model, $key, $index, $widget) {
                $isCompleted = $model->status == Request::STATUS_COMPLETED;
                return '
                    <div class="card card-shadow">
                        <div class="card-header">
                            <h5 class="card-title">Заявка № '. Html::encode($key) .'</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p>ФИО:</p>
                                '. $model->user->full_name .'
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Наименование курса:</p>
                                '. $model->displayCourseName() .'
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Дата начала:</p>
                                '. date('d.m.Y', strtotime($model->start_date)) .'
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Способ оплаты:</p>
                                '. $model->payment->name .'
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Статус:</p>
                                '. $model->displayStatus() .'
                            </div>
                        </div>
                        <div class="card-footer">
                            '. Html::beginForm(['update-status'], 'post', ['class' => 'd-flex gap-2']) .
                                Html::hiddenInput('id', $model->id) .
                                Html::dropDownList('status', $model->status, app\models\Request::optsStatus(), [
                                    'class' => 'form-select form-select-sm',
                                    'style' => 'width: 170px',
                                    'disabled' => $isCompleted,
                                ]) .
                                Html::submitButton('Сохранить', [
                                    'class' => 'btn btn-success btn-sm',
                                    'disabled' => $isCompleted,
                                ]) .
                                Html::endForm()
                            .'
                        </div>
                    </div>
                ';
            }
        ]);
    ?>

<!--    --><?php //= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//            'user.full_name',
//            [
//                'attribute' => 'course_name',
//                'value' => static fn ($model) => $model->displayCourseName(),
//            ],
//            [
//                'attribute' => 'start_date',
//                'format' => ['date', 'php:d.m.Y'],
//            ],
//            [
//                'attribute' => 'payment_id',
//                'value' => static fn ($model) => $model->payment->name,
//            ],
//            [
//                'attribute' => 'status',
//                'value' => static fn ($model) => $model->displayStatus(),
//            ],
//            [
//                'label' => 'Смена статуса',
//                'format' => 'raw',
//                'value' => static function ($model) {
//                    $isCompleted = $model->status == Request::STATUS_COMPLETED;
//                    return Html::beginForm(['update-status'], 'post', ['class' => 'd-flex gap-2']) .
//                        Html::hiddenInput('id', $model->id) .
//                        Html::dropDownList('status', $model->status, app\models\Request::optsStatus(), [
//                            'class' => 'form-select form-select-sm',
//                            'style' => 'width: 170px',
//                            'disabled' => $isCompleted,
//                        ]) .
//                        Html::submitButton('Сохранить', [
//                            'class' => 'btn btn-primary btn-sm',
//                            'disabled' => $isCompleted,
//                        ]) .
//                        Html::endForm();
//                }
//            ],
//        ],
//    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => ArrayHelper::getValue($model, 'category.name'),
            ],
            'name',
            'content:ntext',
            'price',
            'active:boolean',
            [
                'label' => 'Tags',
                'value' => implode(', ', ArrayHelper::map($model->tags, 'id', 'name')),
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Добавить значение', ['admin/values/create', 'product_id' => $model->id], ['class' => 'btn btn-primary'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getValues()->with('productAttribute')]),
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'product_id',
            [
                'attribute' => 'attribute_id',
                'value' => 'productAttribute.name',
            ],
            'value',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'admin/values'
            ],
        ],
    ]); ?>

</div>

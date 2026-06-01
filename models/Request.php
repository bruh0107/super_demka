<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $payment_id
 * @property string $course_name
 * @property string $start_date
 * @property string $status
 *
 * @property Payment $payment
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const COURSE_NAME_OAIP = 'oaip';
    const COURSE_NAME_OWD = 'owd';
    const COURSE_NAME_OPBD = 'opbd';
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 'new'],
            [['payment_id', 'course_name', 'start_date'], 'required'],
            [['user_id', 'payment_id'], 'integer'],
            [['course_name', 'status'], 'string'],
            [['start_date'], 'safe'],
            ['course_name', 'in', 'range' => array_keys(self::optsCourseName())],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            ['user_id', 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'payment_id' => 'Способ оплаты',
            'course_name' => 'Наименование курса',
            'start_date' => 'Дата начала',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    /**
     * column course_name ENUM value labels
     * @return string[]
     */
    public static function optsCourseName()
    {
        return [
            self::COURSE_NAME_OAIP => 'Основы алгоритмизации и программирования',
            self::COURSE_NAME_OWD => 'Основы веб-дизайна',
            self::COURSE_NAME_OPBD => 'Основы проектирования баз данных',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_IN_PROGRESS => 'Идет обучение',
            self::STATUS_COMPLETED => 'Обучение завершено',
        ];
    }

    /**
     * @return string
     */
    public function displayCourseName()
    {
        return self::optsCourseName()[$this->course_name];
    }

    /**
     * @return bool
     */
    public function isCourseNameOaip()
    {
        return $this->course_name === self::COURSE_NAME_OAIP;
    }

    public function setCourseNameToOaip()
    {
        $this->course_name = self::COURSE_NAME_OAIP;
    }

    /**
     * @return bool
     */
    public function isCourseNameOwd()
    {
        return $this->course_name === self::COURSE_NAME_OWD;
    }

    public function setCourseNameToOwd()
    {
        $this->course_name = self::COURSE_NAME_OWD;
    }

    /**
     * @return bool
     */
    public function isCourseNameOpbd()
    {
        return $this->course_name === self::COURSE_NAME_OPBD;
    }

    public function setCourseNameToOpbd()
    {
        $this->course_name = self::COURSE_NAME_OPBD;
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusNew()
    {
        return $this->status === self::STATUS_NEW;
    }

    public function setStatusToNew()
    {
        $this->status = self::STATUS_NEW;
    }

    /**
     * @return bool
     */
    public function isStatusInprogress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function setStatusToInprogress()
    {
        $this->status = self::STATUS_IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isStatusCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function setStatusToCompleted()
    {
        $this->status = self::STATUS_COMPLETED;
    }
}

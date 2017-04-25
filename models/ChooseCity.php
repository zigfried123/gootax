<?php

namespace app\models;


/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 */
class ChooseCity extends \yii\db\ActiveRecord
{


    public $city;


    public function getRecalls()
    {
        return $this->hasOne(Recalls::className(), ['id_city' => 'id']);
    }


    public static function tableName()
    {
        return 'cities';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'city' => 'Выберите ваш город:'
        ];
    }


    public static function getList()
    {

        $data = self::getDb()->cache(function ($db) {

            return self::find()->joinWith('recalls')->where('recalls.id_city = cities.id')->orderBy("name")->all();

        });

        return $data;
    }


}

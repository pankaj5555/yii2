<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $loc_id
 * @property string $zip_code
 * @property string $city
 * @property string $province
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loc_id', 'zip_code', 'city', 'province'], 'required'],
            [['loc_id'], 'integer'],
            [['zip_code'], 'integer'],
            [['zip_code'], 'unique', 'message'=>"Email already exists "],
            [['city'], 'string', 'max' => 100],
            [['province'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loc_id' => 'Loc ID',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}

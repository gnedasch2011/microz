<?php

namespace app\models\booking;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $reservation_id
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'reservation_id' => 'Reservation ID',
        ];
    }

    public static function createNewClient($data)
    {
        $existUser = self::find()->where(['email' => $data->email])->one();

        if ($existUser) {
            return $existUser;
        } else {
            $new = new self;
            $new->attributes = $data->attributes;
            $new->save();
            return $new;
        }

    }



}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pack_size".
 *
 * @property int $id
 * @property string $title
 * @property int $size
 */
class PackSize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pack_size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'size'], 'required'],
            [['size'], 'integer', 'min' => 1],
            [['title'], 'string', 'max' => 64],
            [['size'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'size' => 'Size',
        ];
    }
}

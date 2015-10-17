<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property string $coddpto
 * @property string $nombredpto
 *
 * @property Persona[] $personas
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coddpto', 'nombredpto'], 'required'],
            [['coddpto'], 'integer'],
            [['nombredpto'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coddpto' => 'Codigo',
            'nombredpto' => 'Nombre Departamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['dpto' => 'coddpto']);
    }
}

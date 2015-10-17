<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $cedula
 * @property string $nombre
 * @property string $dpto
 *
 * @property Departamento $dpto0
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula', 'nombre'], 'required'],
            [['cedula', 'dpto'], 'integer'],
            [['nombre'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cedula' => 'Cedula',
            'nombre' => 'Nombre',
            'dpto' => 'Codigo Departamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDpto0()
    {
        return $this->hasOne(Departamento::className(), ['coddpto' => 'dpto']);
    }
}

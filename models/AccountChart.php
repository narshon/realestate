<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_account_chart".
 *
 * @property integer $id
 * @property integer $code
 * @property string $name
 * @property integer $fk_re_account_type
 * @property integer $status
 * @property string $description
 * @property integer $created_by
 * @property integer $modified_by
 * @property integer $created_on
 * @property integer $modified_on
 *
 * @property AccountTypes $fkReAccountType
 * @property AccountMap[] $accountMaps
 */
class AccountChart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_account_chart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code', 'fk_re_account_type', 'status', 'created_by', 'modified_by', 'created_on', 'modified_on'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['fk_re_account_type'], 'exist', 'skipOnError' => true, 'targetClass' => AccountTypes::className(), 'targetAttribute' => ['fk_re_account_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'fk_re_account_type' => 'Fk Re Account Type',
            'status' => 'Status',
            'description' => 'Description',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_on' => 'Created On',
            'modified_on' => 'Modified On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkReAccountType()
    {
        return $this->hasOne(AccountTypes::className(), ['id' => 'fk_re_account_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMaps()
    {
        return $this->hasMany(AccountMap::className(), ['fk_account_chart' => 'id']);
    }
}

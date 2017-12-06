<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "re_occupancy_issue".
 *
 * @property integer $id
 * @property integer $fk_occupancy_id
 * @property integer $fk_related_term
 * @property integer $issue_type
 * @property string $title
 * @property string $desc
 * @property integer $_status
 * @property string $status_remarks
 * @property string $date_created
 * @property integer $created_by
 * @property string $date_modified
 * @property integer $modified_by
 *
 * @property OccupancyTerm $fkRelatedTerm
 * @property Occupancy $fkOccupancy
 */
class OccupancyIssue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 're_occupancy_issue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['fk_occupancy_id', 'fk_related_term', 'issue_type'], 'required'],
            [['fk_occupancy_id', 'fk_related_term', 'issue_type', '_status', 'created_by', 'modified_by'], 'integer'],
            [['desc', 'status_remarks'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['fk_related_term'], 'exist', 'skipOnError' => true, 'targetClass' => OccupancyTerm::className(), 'targetAttribute' => ['fk_related_term' => 'id']],
            [['fk_occupancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupancy::className(), 'targetAttribute' => ['fk_occupancy_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_occupancy_id' => 'Fk Occupancy ID',
            'fk_related_term' => 'Fk Related Term',
            'issue_type' => 'Issue Type',
            'title' => 'Title',
            'desc' => 'Desc',
            '_status' => 'Status',
            'status_remarks' => 'Status Remarks',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'date_modified' => 'Date Modified',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkRelatedTerm()
    {
        return $this->hasOne(OccupancyTerm::className(), ['id' => 'fk_related_term']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOccupancy()
    {
        return $this->hasOne(Occupancy::className(), ['id' => 'fk_occupancy_id']);
    }
}

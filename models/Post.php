<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $author_id
 * @property integer $status
 *
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'author_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }
    
    public function beforeSave($insert) {
        $time = time();
        if($insert) {
            $this->created_at = $time;
            $this->status = 1;
            $this->author_id = Yii::$app->user->id;
        }
        $this->updated_at = $time;
        return parent::beforeSave($insert);        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/post', 'ID'),
            'title' => Yii::t('app/post', 'Title'),
            'content' => Yii::t('app/post', 'Content'),
            'created_at' => Yii::t('app/post', 'Created At'),
            'updated_at' => Yii::t('app/post', 'Updated At'),
            'author_id' => Yii::t('app/post', 'Author ID'),
            'status' => Yii::t('app/post', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}

<?php

namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;
use yii\db\Exception;
use app\models\Balance;
use app\components\Common;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property string $name
 * @property string $surname
 * @property string $skype
 * @property string $ref_link
 * @property integer $inviter_user_id
 * @property string $last_visit_date
 *
 * @property Profile $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 */
class User extends BaseUser {
    
    const ROLE_GUEST = 'guest';
    
    const ROLE_PARTICIPANT = 'participant';
    
    const ROLE_ADMIN = 'admin';
    
    const ROLE_SUBADMIN = 'subadmin';
    
    const ROLE_REGISTERED = 'registered';
    
    const ROLE_AUTHOR = 'author';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at', 'ref_link', 'last_visit_date'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'inviter_user_id'], 'integer'],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['name', 'surname', 'skype', 'ref_link'], 'string', 'max' => 14],
            [['last_visit_date'], 'string', 'max' => 11],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'flags' => Yii::t('app', 'Flags'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'skype' => Yii::t('app', 'Skype'),
            'ref_link' => Yii::t('app', 'Ref Link'),
            'inviter_user_id' => Yii::t('app', 'Inviter User ID'),
            'last_visit_date' => Yii::t('app', 'Last Visit Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(\dektrium\user\models\Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(\dektrium\user\models\SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(\dektrium\user\models\Token::className(), ['user_id' => 'id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getInviter() {
        return $this->hasOne(static::className(), ['id' => 'inviter_user_id']);
    }
    
    public static function findByRef($ref) {
        return static::findOne(['ref_link' => $ref]);
    }
    
    public function getReferalList() {
        return $this->hasMany(static::className(), ['inviter_user_id' => 'id']);
    }
    
    public static function getReferals(array $users) {
        $maxLevel = RefProfit::find()->count();
        $items = [];
        $level = $i = 0;
        $border = 1;
        $currentCount = 1;
        
        $levelItems = [];
        $levelI = 0;
        
        while(!empty($users)) {
            $cur = array_shift($users);
            if($levelI <= $maxLevel) {
                $items[$level][] = $cur;
                
                $levelItems[$levelI][$cur->inviter_user_id][] = $cur;
                if(!$cur->inviter_user_id) {
                    $levelI = 0;
                } else {
                    foreach ($levelItems as $k => $lev) {
                        foreach($lev as $ik => $ll) {
                            if($ik == $cur->inviter_user_id) {
                                $levelI = $k + 1;
                            }
                        }
                    }
                }
                if(!isset($levelItems[$levelI])) {
                    $levelItems[$levelI] = [];
                }
                if(!isset($levelItems[$levelI][$cur->inviter_user_id])) {
                    $levelItems[$levelI][$cur->inviter_user_id] = [];
                }
                
                
                $refList = $cur->referalList;
                $users = ArrayHelper::merge($users, $refList);
                $currentCount += count($users);
            } else {
                break;
            }
            
            ++$i;
            if($i >= $border) {
                $border = $currentCount;
                $level++;
            }
        }
        return $items;
    }
    
    public static function getInviterARByRef($refLink) {
        return static::find()->where(['ref_link' => $refLink])->one();
    }
    
    public function getIsAdmin() {
        return $this->id == 1;
    }
    
    public function beforeSave($insert) {
        if($insert) {
            $this->setAttribute('ref_link', substr(md5($this->username.time()),0,8));
            $session = Yii::$app->session;
            $inviter_user_id = 0;
            if(($refLink = $session->get('ref')) !== null) {
                $invAR = static::getInviterARByRef($refLink);
                if($invAR !== null) {
                    $inviter_user_id = $invAR->getAttribute('id');
                }
            }
            $this->setAttribute('inviter_user_id',$inviter_user_id);
            $this->setAttribute('last_visit_date',time());
        }
        return parent::beforeSave($insert);
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if(($auth = Yii::$app->authManager) !== null) {
            $participant = $auth->getRole('participant');
            if($participant !== null) {
                $auth->assign($participant, $this->id);
            }
        }
        return true;
    }
    
    public function isBelongsToRole($role = self::ROLE_PARTICIPANT) {
        $res = false;
        if(!Yii::$app->user->isGuest) {
            $auth = Yii::$app->authManager;
            $userRoles = $auth->getRolesByUser(Yii::$app->user->id);
            $role = $auth->getRole($role);
            if(in_array($role, $userRoles)) {
                return true;
            }
        } else if($role == self::ROLE_GUEST) {
            $res = true;
        }
        return $res;
    }
    
    public function IsAdmin() {
        return ($this->isBelongsToRole(self::ROLE_ADMIN) || $this->isBelongsToRole(self::ROLE_SUBADMIN));
    }
}

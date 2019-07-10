<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $surname
 * @property string $name
 * @property string $patronumic
 * @property string $phone
 * @property string $about
 * @property string $photo
 * @property int $city_id
 * @property int $gender_id
 * @property int $role_id
 * @property string $auth_key
 * @property string $password_hash
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Profession[] $professions
 * @property City $city
 * @property Gender $gender
 * @property Role $role
 * @property Status $status
 */

class User extends ActiveRecord implements IdentityInterface
{
    public $image;
    
    public function SetBreadcrumbs(){
        return ['label'=>$this->surname." ".$this->name, 'url'=>['users/about','id'=>$this->id]];
    }

    public static function findIdentity($id)
    {
    	return static::findOne(['id'=>$id,'status_id'=>1]);
    } 

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByEmail($email)
    {
    	return static::findOne(['email'=>$email,'status_id'=>1]);
    }

    public function getId()
    {
    	return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
    	return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
    	return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
    	return $this->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
    	$this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
    	$this->auth_key = Yii::$app->security->generateRandomString();
    }


    public static function tableName()
    {
        return 'user';
    }

    
    public function rules()
    {
        return [
            [['surname', 'name', 'city_id', 'gender_id'], 'required'],
            [['about','photo'], 'string'],
            [['image'], 'file', 'extensions' => 'jpg'],
            [['city_id', 'gender_id'], 'integer'],
            [['surname', 'name', 'patronumic'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 45],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronumic' => 'Отчество',
            'phone' => 'Телефон',
            'about' => 'О себе',
            'photo' => 'Фото',
            'city_id' => 'Город',
            'gender_id' => 'Пол',
        ];
    }


    public function addInfo(){
        if(!$this->validate()){
            return null;
        }
        $user=User::find()->where(['id' => $this->id])->one();
        $user->surname=$this->surname;
        $user->name=$this->name;
        $user->patronumic=$this->patronumic;
        $user->phone=$this->phone;
        $user->about=$this->about;
        $user->bithday=date('Y-m-d', strtotime($this->bithday));
        $user->city_id=$this->city_id;
        $user->gender_id=$this->gender_id;
        if($this->image){
            $user->photo=Yii::$app->request->baseUrl.'/files/users_photo/'.$this->image->name;
            $this->image->saveAs(Yii::getAlias('@webroot') . '/files/users_photo/' . $this->image->name);
        }
        else{
            $user->photo=$this->photo;
        }
        return ($user->save()) ? $user : null;
    }


    
    public function AllGender(){
        return ArrayHelper::map(Gender::find()->all(),'id','name');
    }


    public function AllCity(){
        return ArrayHelper::map(City::find()->all(),'id','name');
    }


    public function getProfessions()
    {
        return $this->hasMany(Profession::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}

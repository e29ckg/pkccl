<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord {

    public static function tableName() {
        return 'user';
    }

    public function attributeLabels() {
        return [
            'name' => 'ชื่อ',
            'usr' => 'Username',
            'pwd' => 'Password',
            'level' => 'ระดับการใช้งาน'
        ];
    }

    public static function level() {
        return [
            'admin' => 'ผู้ดูแลระบบ',
            'manager' => 'ผู้จัดการ'
        ];
    }

    public function rules() {
        return [
            [['name', 'usr', 'pwd'], 'required'],
            [['usr'], 'unique']
        ];
    }

}

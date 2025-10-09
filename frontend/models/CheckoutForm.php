<?php

namespace frontend\models;

use Yii\base\Model;

class CheckoutForm extends Model
{
    public $shipping_address;
    public $phone;
    public $payment = 'cash on delivery';


    public function rules()
    {
        return[
            [['shipping_address','phone'],'required'],
            [['shipping_address'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return[
            'shipping_address' => 'Shipping Address',
            'phone' =>'Phone',
            'payment' => 'payment',
        ];
    }
  

}
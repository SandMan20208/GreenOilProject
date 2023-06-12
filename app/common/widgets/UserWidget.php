<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;

class UserWidget extends Widget
{
    public $user;

    public function __construct($config = [])
    {
        $this->user = Yii::$app->user->identity;
        parent::__construct($config);
    }

    public function run()
    {
        $username = $this->user->login ?? 'Неизвестный';
        return "<div class=\"user-container\">
                    <img class=\"user_icon\" src=\"/image/user_icon.png\">
                    $username
               </div>";
    }
}
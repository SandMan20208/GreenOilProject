<?php

namespace common\widgets;

use common\models\active_records\User;
use yii\base\Widget;

class UserWidget extends Widget
{
    public User $user;

    public function run()
    {
       return "<div class=\"user-container\">
                    <img class=\"user_icon\" src=\"/image/user_icon.png\">
                    {$this->user->name}
               </div>";
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: csexplorer
 * Date: 8/11/2019
 * Time: 11:10 PM
 */

namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user group matches
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->role_group;
            if ($item->name === 'admin') {
                return $group == 1;
            } elseif ($item->name === 'teacher') {
                return $group == 1 || $group == 2;
            }
        }
        return false;
    }
}
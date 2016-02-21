<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user can see own account
 */
class OwnPostRule extends Rule
{
    public $name = 'ownAccount';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return (isset($params['post']) && $params['post']->author_id == $user) ? true : false;
    }
}
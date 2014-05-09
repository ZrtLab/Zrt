<?php


/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: CurrentUserInfo.php 69 2010-09-08 12:32:03Z jamie $
 */


/**
 * Displays current user information.
 *
 * @class Zrt_View_Helper_CurrentUserInfo
 * @ingroup Zrt_View_Helpers
 */
class Zrt_View_Helper_CurrentUserInfo
        extends Zend_View_Helper_Abstract
    {


    /**
     * Displays the name of the current user, and a logout button.
     *
     * @param string $type
     * @return string
     */
    public function currentUserInfo()
        {


        ?>
        <div id="current_user_info">
            Logged in as: <a href="/settings/" title="Change Preferences"><?= Zend_Auth::getInstance()->getIdentity()->realname ?></a> | <a href="/logout/">Logout</a>
        </div>
        <?php


        }


    }


?>
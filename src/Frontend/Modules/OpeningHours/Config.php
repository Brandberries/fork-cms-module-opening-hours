<?php

namespace Frontend\Modules\OpeningHours;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Config as FrontendBaseConfig;

/**
 * This is the configuration-object
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.be>
 */
class Config extends FrontendBaseConfig
{
    /**
     * The default action
     *
     * @var	string
     */
    protected $defaultAction = '';

    /**
     * The disabled actions
     *
     * @var	array
     */
    protected $disabledActions = array();
}

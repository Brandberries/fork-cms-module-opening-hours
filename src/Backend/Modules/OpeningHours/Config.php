<?php

namespace Backend\Modules\OpeningHours;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use \Symfony\Component\HttpKernel\KernelInterface;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;
use Backend\Core\Engine\Language as BL;
use Backend\Core\Engine\Model as BackendModel;

/**
 * This is the configuration-object for the OpeningHours module
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.com>
 */
class Config extends BackendBaseConfig
{
    /**
     * The default action
     *
     * @var    string
     */
    protected $defaultAction = 'Settings';

    /**
     * The disabled actions
     *
     * @var    array
     */
    protected $disabledActions = array();


}

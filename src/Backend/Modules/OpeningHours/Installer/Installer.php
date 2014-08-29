<?php

namespace Backend\Modules\OpeningHours\Installer;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\OpeningHours\Engine\Model as BackendOpeningHoursModel;

/**
 * Installer for the OpeningHours-module
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.be>
 */
class Installer extends ModuleInstaller
{

    /**
     * Install the module
     */
    public function install()
    {

		// install the OpeningHours module
		$this->installModule();

        // install settings
        $this->installSettings();

        // install locale
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        // settings navigation
        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, 'OpeningHours', 'opening_hours/settings');
    }

    /**
     * Install the module and it's actions
     */
    private function installModule()
    {

		// add 'OpeningHours' as a module
		$this->addModule('OpeningHours');

		// insert the frontend widget
		$this->insertExtra(
			'OpeningHours',
			'widget',
			'Today',
			'Today',
			null,
			'N',
			1701
		);

		// module rights
        $this->setModuleRights(1, 'OpeningHours');

        // action rights
        $this->setActionRights(1, 'OpeningHours', 'Settings');

    }



    /**
     * Install settings
     */
    private function installSettings()
    {

		foreach(BackendOpeningHoursModel::$days as $day) {

			$this->setSetting('OpeningHours', $day . '_start1', '08:00');
			$this->setSetting('OpeningHours', $day . '_stop1', '17:00');
			$this->setSetting('OpeningHours', $day . '_start2', '');
			$this->setSetting('OpeningHours', $day . '_stop2', '');

		}

		$this->setSetting('OpeningHours', 'closed', '20/04/2014
21/04/2014
29/04/2014
01/01
01/05
21/07
14/08
01/11
11/11
25/12');

    }
}

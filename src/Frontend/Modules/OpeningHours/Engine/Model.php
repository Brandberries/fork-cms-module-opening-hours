<?php

namespace Frontend\Modules\OpeningHours\Engine;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Model as FrontendModel;
use Backend\Modules\OpeningHours\Engine\Model as BackendOpeningHoursModel;

/**
 * In this file we store all generic functions that we will be using in the location module
 *
 * @author Matthias Mullie <forkcms@mullie.eu>
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class Model
{


	/**
	 * Fetch all the settings for today
	 *
	 * @param int $weekDay
	 * @return array
	 */
	public static function getToday()
	{
		$settings = array();

		$closedOn = explode('
', FrontendModel::getModuleSetting('OpeningHours', 'closed', ''));

		foreach ($closedOn as $closed) {
			if ($closed == substr(date('d/m/Y'), 0, strlen($closed))) {
				$settings["closedExtraordinary"] = true;
				return $settings;
			}
		}


		$dayname = BackendOpeningHoursModel::$days[date('N')-1];

		$start1 = FrontendModel::getModuleSetting('OpeningHours', $dayname . '_start1', '08:00');
		$stop1 = FrontendModel::getModuleSetting('OpeningHours', $dayname . '_stop1', '17:00');
		$start2 = FrontendModel::getModuleSetting('OpeningHours', $dayname . '_start2', '');
		$stop2 = FrontendModel::getModuleSetting('OpeningHours', $dayname . '_stop2', '');

		// we are closed, like in every week
		if (empty($start1) && empty($start2)) {
			$settings["closed"] = true;
			return $settings;
		}

		if (!empty($start1)) {
			$settings["start1"] = $start1;
			$settings["stop1"] = $stop1;
		}

		if (!empty($start2)) {
			$settings["start2"] = $start2;
			$settings["stop2"] = $stop2;
		}

		if (!empty($start1) && !empty($start2)) {
			$settings['bothTimes'] = true;
		}


		return $settings;
	}
}

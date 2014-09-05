<?php

namespace Frontend\Modules\OpeningHours\Widgets;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Language as FL;
use Frontend\Modules\OpeningHours\Engine\Model as FrontendOpeningHoursModel;
use Backend\Modules\OpeningHours\Engine\Model as BackendOpeningHoursModel;

/**
 * This is the ThisWeek-widget: It displays the roster of this week
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.be>
 */
class ThisWeek extends FrontendBaseWidget
{
	/**
	 * @var array
	 */
	protected $days = array();
	protected $partOne = false;
	protected $partTwo = false;
	protected $partOneAndTwo = false;

	public function execute()
	{
		parent::execute();

		$this->loadTemplate();
		$this->loadData();

		$this->parse();
	}

	/**
	 * Load the data
	 */
	protected function loadData()
	{

		$dayLength = 60*60*24;
		$today = date('N');


		// walk all the days of this week
		for ($i = 1 - $today; $i <= 1 - $today + 6; $i++) {

			// add this day
			$this->days[] = FrontendOpeningHoursModel::getDay(time() + ($i * $dayLength));

			// add the label of today
			$this->days[count($this->days) - 1]['dayName'] = FL::getLabel(ucfirst(BackendOpeningHoursModel::$days[$i + $today - 1]));

			// add flag to check if we ever use the first part of the day
			if (isset($this->days[count($this->days) - 1]['start1'])) {
				$this->partOne = true;
			}

			// add flag to check if we ever use the seconde part of the day
			if (isset($this->days[count($this->days) - 1]['start2'])) {
				$this->partTwo = true;
			}

			if ($i == 0) {
				// add a flag that shows which day is today
				$this->days[count($this->days) - 1]['today'] = true;
			}
		}

		// add flag to check if we ever use the two parts of the day
		if ($this->partOne && $this->partTwo) {
			$this->partOneAndTwo = true;
		}


	}

	/**
	 * Parse the data into the template
	 */
	private function parse()
	{
		$this->tpl->assign('days', $this->days);
		$this->tpl->assign('partOneAndTwo', $this->partOneAndTwo);
	}
}

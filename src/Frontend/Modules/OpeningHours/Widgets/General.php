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
class General extends FrontendBaseWidget
{
	/**
	 * @var array
	 */
	protected $days = array();
	protected $partOne = false;
	protected $partTwo = false;
	protected $partOneAndTwo = false;
	protected $closed = false;

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
			$this->days[] = FrontendOpeningHoursModel::getDay(time() + ($i * $dayLength), true);

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

		}

		// add flag to check if we ever use the two parts of the day
		if ($this->partOne && $this->partTwo) {
			$this->partOneAndTwo = true;
		}


		$closedOn = explode('
', FrontendModel::getModuleSetting('OpeningHours', 'closed', ''));

		$closedDates = array();

		foreach ($closedOn as $closed) {

			$dataArray = explode('/', $closed);

			$dataArray[1] = (int) $dataArray[1];
			$dataArray[1] = (int) $dataArray[1];

			$element = array();

			//year is given
			if (isset($dataArray[2])) {

				$dataArray[2] = (int) $dataArray[2];

				$date = strtotime($dataArray[2] .'-' . $dataArray[1] . '-' . $dataArray[0]);

				if ($date > time()) {
					$element["date"] = $date;
				}

//				echo '<pre>1. ' . $dataArray[2] .'-' . $dataArray[1] . '-' . $dataArray[0] . '</pre>';
			// year is not given
			} else {

				$date = strtotime(date('Y') . '-' . $dataArray[1] .'-' . $dataArray[0]);
//				echo '<pre>2. ' . $date . '</pre>';
				if ($date > time()) {
					$element["date"] = $date;
				} else {
					$element["date"] = strtotime((date('Y')+1) . '-' . $dataArray[1] .'-' . $dataArray[0]);
				}
			}
			if(isset($element["date"])) {
				$this->closed[] = $element;
			}
		}

		asort($this->closed);

	}

	/**
	 * Parse the data into the template
	 */
	private function parse()
	{
		$this->tpl->assign('days', $this->days);
		$this->tpl->assign('partOneAndTwo', $this->partOneAndTwo);
		$this->tpl->assign('closed', $this->closed);
	}
}

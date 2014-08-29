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
use Frontend\Modules\OpeningHours\Engine\Model as FrontendOpeningHoursModel;

/**
 * This is the Today-widget: It displays if 'we' are opening up today
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.be>
 */
class Today extends FrontendBaseWidget
{
	/**
	 * @var array
	 */
	protected $settings = array();

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

		$this->settings = FrontendOpeningHoursModel::getToday();

	}

	/**
	 * Parse the data into the template
	 */
	private function parse()
	{
		$this->tpl->assign('settings', $this->settings);
	}
}

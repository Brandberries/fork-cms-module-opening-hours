<?php

namespace Backend\Modules\OpeningHours\Actions;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;
use Backend\Core\Engine\Form as BackendForm;
use Backend\Core\Engine\Language as BL;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\OpeningHours\Engine\Model as BackendOpeningHoursModel;

/**
 * This is the settings-action, it will display a form to set general location settings
 *
 * @author Stef Bastiaansen <stef.bastiaansen@wijs.be>
 */
class Settings extends BackendBaseActionEdit
{



    public function execute()
    {
        parent::execute();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
        $this->display();
    }


    private function loadForm()
    {
        $this->frm = new BackendForm('settings');

		foreach (BackendOpeningHoursModel::$days as $day) {
			$this->frm->addTime($day . '_start1', BackendModel::getModuleSetting($this->URL->getModule(), $day . '_start1', '08:00'));
			$this->frm->addTime($day . '_stop1', BackendModel::getModuleSetting($this->URL->getModule(), $day . '_stop1', '17:00'));
			$this->frm->addTime($day . '_start2', BackendModel::getModuleSetting($this->URL->getModule(), $day . '_start2', ''));
			$this->frm->addTime($day . '_stop2', BackendModel::getModuleSetting($this->URL->getModule(), $day . '_stop2', ''));
		}

		$closed = BackendModel::getModuleSetting($this->URL->getModule(), 'closed', '20/04/2014
21/04/2014
29/04/2014
01/01
01/05
21/07
14/08
01/11
11/11
25/12');

		$this->frm->addTextarea('closed',$closed, 'bigger', null, false);

    }



	private static function validHour($hour)
	{
		$pattern = '/([01]?[0-9]|2[0-3]):[0-5][0-9]/';

		return preg_match($pattern, $hour);
	}

    private function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            $this->frm->cleanupFields();

			foreach (BackendOpeningHoursModel::$days as $day) {

				$start1 = $this->frm->getField($day . '_start1')->getValue();
				$stop1 = $this->frm->getField($day . '_stop1')->getValue();
				$start2 =  $this->frm->getField($day . '_start2')->getValue();
				$stop2 =  $this->frm->getField($day . '_stop2')->getValue();

				if (!empty($start1)) {

					if (!self::validHour($start1)) {
						$this->frm->getField($day . '_start1')->addError(Bl::getError('FillInCorrectTime'));
					}

					if (!self::validHour($stop1)) {
						$this->frm->getField($day . '_stop1')->addError(Bl::getError('FillInCorrectTime'));
					}

					if (self::validHour($start1) && self::validHour($stop1) && $start1 >= $stop1) {
						$this->frm->getField($day . '_start1')->addError(Bl::getError('FillInCorrectTime'));
						$this->frm->getField($day . '_stop1')->addError(Bl::getError('FillInCorrectTime'));
					}

				}
				else if(!empty($stop1)) {
					$this->frm->getField($day . '_start1')->addError(Bl::getError('FillInCorrectTime'));
				}


				if (!empty($start2)) {

					if (!self::validHour($start2)) {
						$this->frm->getField($day . '_start2')->addError(Bl::getError('FillInCorrectTime'));
					}

					if (!self::validHour($stop2)) {
						$this->frm->getField($day . '_stop2')->addError(Bl::getError('FillInCorrectTime'));
					}

					if (self::validHour($start2) && self::validHour($stop2) && $start2 >= $stop2) {
						$this->frm->getField($day . '_start2')->addError(Bl::getError('FillInCorrectTime'));
						$this->frm->getField($day . '_stop2')->addError(Bl::getError('FillInCorrectTime'));
					}

				}
				else if(!empty($stop2)) {
					$this->frm->getField($day . '_start2')->addError(Bl::getError('FillInCorrectTime'));
				}

				if (self::validHour($stop1) && self::validHour($start2) && $start2 < $stop1) {
					$this->frm->getField($day . '_stop1')->addError(Bl::getError('FillInCorrectTime'));
					$this->frm->getField($day . '_start2')->addError(Bl::getError('FillInCorrectTime'));
				}


				BackendModel::setModuleSetting($this->URL->getModule(), $day . '_start1', (string) $this->frm->getField($day . '_start1')->getValue());
				BackendModel::setModuleSetting($this->URL->getModule(), $day . '_stop1', (string) $this->frm->getField($day . '_stop1')->getValue());
				BackendModel::setModuleSetting($this->URL->getModule(), $day . '_start2', (string) $this->frm->getField($day . '_start2')->getValue());
				BackendModel::setModuleSetting($this->URL->getModule(), $day . '_stop2', (string) $this->frm->getField($day . '_stop2')->getValue());
			}


            if ($this->frm->isCorrect()) {

				foreach (BackendOpeningHoursModel::$days as $day) {
					BackendModel::setModuleSetting($this->URL->getModule(), $day . '_start1', (string) $this->frm->getField($day . '_start1')->getValue());
					BackendModel::setModuleSetting($this->URL->getModule(), $day . '_stop1', (string) $this->frm->getField($day . '_stop1')->getValue());
					BackendModel::setModuleSetting($this->URL->getModule(), $day . '_start2', (string) $this->frm->getField($day . '_start2')->getValue());
					BackendModel::setModuleSetting($this->URL->getModule(), $day . '_stop2', (string) $this->frm->getField($day . '_stop2')->getValue());
				}

                BackendModel::setModuleSetting($this->URL->getModule(), 'closed', (string) $this->frm->getField('closed')->getValue());

                // trigger event
                BackendModel::triggerEvent($this->getModule(), 'after_saved_settings');

                // redirect to the settings page
                $this->redirect(BackendModel::createURLForAction('Settings') . '&report=saved');
            }

        }
    }
}

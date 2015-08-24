<?php
namespace Concrete\Controller\SinglePage\Dashboard\Pages\Types;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Loader;
use PageType;
use PageTemplate;
use \Concrete\Core\Page\Type\PublishTarget\Type\Type as PageTypePublishTargetType;
class Add extends DashboardPageController {

	public function submit() {
		$vs = Loader::helper('validation/strings');

		$sec = Loader::helper('security');
		$name = $sec->sanitizeString($this->post('ptName'));
		$handle = $sec->sanitizeString($this->post('ptHandle'));
		if (!$this->token->validate('add_page_type')) { 
			$this->error->add(t($this->token->getErrorMessage()));
		}
		if (!$vs->notempty($name)) {
			$this->error->add(t('You must specify a valid name for your page type.'));
		}
		if (!$vs->handle($handle)) {
			$this->error->add(t('You must specify a valid handle for your page type.'));
		}
		$defaultTemplate = PageTemplate::getByID($this->post('ptDefaultPageTemplateID'));
		if (!is_object($defaultTemplate)) {
			$this->error->add(t('You must choose a valid default page template.'));
		}
		$templates = array();
		if (is_array($_POST['ptPageTemplateID'])) {
			foreach($this->post('ptPageTemplateID') as $pageTemplateID) {
				$pt = PageTemplate::getByID($pageTemplateID);
				if (is_object($pt)) {
					$templates[] = $pt;
				}
			}
		}
		if (count($templates) == 0 && $this->post('ptAllowedPageTemplates') == 'C') {
			$this->error->add(t('You must specify at least one page template.'));
		}
		$target = PageTypePublishTargetType::getByID($this->post('ptPublishTargetTypeID'));
		if (!is_object($target)) {
			$this->error->add(t('Invalid page type publish target type.'));
		}

		if (!$this->error->has()) {
			$data = array(
				'handle' => $handle,
				'name' => $name,
				'defaultTemplate' => $defaultTemplate,
				'ptLaunchInComposer' => $this->post('ptLaunchInComposer'),
                'ptIsFrequentlyAdded' => $this->post('ptIsFrequentlyAdded'),
				'allowedTemplates' => $this->post('ptAllowedPageTemplates'),
				'templates' => $templates
			);
			$pt = PageType::add($data);
			$configuredTarget = $target->configurePageTypePublishTarget($pt, $this->post());
			$pt->setConfiguredPageTypePublishTargetObject($configuredTarget);
			$this->redirect('/dashboard/pages/types', 'page_type_added');
		}
	}

}

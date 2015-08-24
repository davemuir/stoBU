<?php
namespace Concrete\Controller\Panel\Detail\Page;
use \Concrete\Controller\Backend\UserInterface\Page as BackendInterfacePageController;
use PageEditResponse;
use PageType;
use View;
use Loader;
use PageTemplate;
use User;
use Core;

class Composer extends BackendInterfacePageController {

	protected $viewPath = '/panels/details/page/composer';

	protected function canAccess() {
		return $this->permissions->canEditPageContents();
	}

	public function view() {
		$pagetype = PageType::getByID($this->page->getPageTypeID());
		$id = $this->page->getCollectionID();
		$saveURL = View::url('/dashboard/composer/write', 'save', 'draft', $id);
		$viewURL = View::url('/dashboard/composer/write', 'draft', $id);
		$this->set('saveURL', $saveURL);
		$this->set('viewURL', $viewURL);
		$this->set('pagetype', $pagetype);
	}

	public function autosave() {
		$r = $this->save();
		$ptr = $r[0];
		if (!$ptr->error->has()) {
			$ptr->setMessage(t('Page saved on %s', Core::make('helper/date')->formatDateTime($ptr->time, true, true)));
		}
		$ptr->outputJSON();
	}

    public function saveAndExit() {
        $r = $this->save();
        $ptr = $r[0];
        $u = new User();
        $c = \Page::getByID($u->getPreviousFrontendPageID());
        $ptr->setRedirectURL($c->getCollectionLink(true));
        $ptr->outputJSON();
    }

    public function publish() {
		$r = $this->save();
		$ptr = $r[0];
		$pagetype = $r[1];
		$outputControls = $r[2];

		$c = $this->page;
        $e = $ptr->error;
		if (!$c->getPageDraftTargetParentPageID()) {
			$e->add(t('You must choose a page to publish this page beneath.'));
		} else {
            $target = \Page::getByID($c->getPageDraftTargetParentPageID());
            $ppc = new \Permissions($target);
            $pagetype = $c->getPageTypeObject();
            if (!$ppc->canAddSubCollection($pagetype)) {
                $e->add(t('You do not have permission to publish a page in this location.'));
            }
        }

		foreach($outputControls as $oc) {
			if ($oc->isPageTypeComposerFormControlRequiredOnThisRequest()) {
				$r = $oc->validate();
				if ($r instanceof \Concrete\Core\Error\Error) {
					$e->add($r);
				}
			}
		}

		$ptr->setError($e);

		if (!$e->has()) {
			$pagetype->publish($c);
			$ptr->setRedirectURL(Loader::helper('navigation')->getLinkToCollection($c));
		}
		$ptr->outputJSON();
	}

	public function discard() {
		$ptr = new PageEditResponse();
		if ($this->permissions->canDeletePage() && $this->page->isPageDraft()) {
			$this->page->delete();
			$u = new User();
			$cID = $u->getPreviousFrontendPageID();
			$ptr->setRedirectURL(DIR_REL . '/' . DISPATCHER_FILENAME . '?cID=' . $cID);
		} else {
			$e = Loader::helper('validation/error');
			$e->add(t('You do not have permission to discard this page.'));
			$ptr->setError($e);
		}

		$ptr->outputJSON();
	}

	protected function save() {
		$c = $this->page;
		$ptr = new PageEditResponse($e);
		$ptr->setPage($c);

		$pagetype = $c->getPageTypeObject();
        if ($_POST['ptComposerPageTemplateID']) {
    		$pt = PageTemplate::getByID($_POST['ptComposerPageTemplateID']);
        }
		if (!is_object($pt)) {
			$pt = $pagetype->getPageTypeDefaultPageTemplateObject();
		}
		$e = $pagetype->validateCreateDraftRequest($pt);
        $outputControls = array();
		if (!$e->has()) {
			$c = $c->getVersionToModify();
            $this->page = $c;

			/// set the target
			$configuredTarget = $pagetype->getPageTypePublishTargetObject();
			$targetPageID = $configuredTarget->getPageTypePublishTargetConfiguredTargetParentPageID();
			if (!$targetPageID) {
				$targetPageID = $_POST['cParentID'];
			}

			$c->setPageDraftTargetParentPageID($targetPageID);
			$outputControls = $pagetype->savePageTypeComposerForm($c);
		}
        $ptr->setError($e);
		return array($ptr, $pagetype, $outputControls);
	}

}
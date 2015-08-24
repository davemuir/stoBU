<?php
namespace Concrete\Core\Application\Service\Dashboard;
use Config;
use Loader;
use PageList;
use TaskPermission;
use Cookie;
use stdClass;
use Permissions;
use PageType;
use Page;
use PermissionKey;

class Sitemap {


	protected $autoOpenNodes = true;
	protected $displayNodePagination = false;
	protected $includeSystemPages;

	public function setAutoOpenNodes($autoOpen) {
		$this->autoOpenNodes = $autoOpen;
	}

	public function includeSystemPages() {
		if (!isset($this->includeSystemPages)) {
			$this->includeSystemPages = Cookie::get('includeSystemPages');
		}
		return $this->includeSystemPages;
	}

	public function setIncludeSystemPages($systemPages) {
		$this->includeSystemPages = $systemPages;
		Cookie::set('includeSystemPages', $systemPages);
	}

	public function setDisplayNodePagination($paginate) {
		$this->displayNodePagination = $paginate;
	}

	function getSubNodes($cID) {
		$db = Loader::db();

		$obj = new stdClass;
		$pl = new PageList();
        $pl->setPermissionsChecker(function($page) {
            $cp = new \Permissions($page);
            return $cp->canViewPageInSitemap();
        });
        $pl->includeAliases();
		$pl->sortByDisplayOrder();
		if ($this->includeSystemPages()) {
			$pl->includeSystemPages();
			$pl->includeInactivePages();
		}
		$pl->filterByParentID($cID);
        $pl->setPageVersionToRetrieve(\Concrete\Core\Page\PageList::PAGE_VERSION_RECENT);

		if ($cID == 1) {
			$results = $pl->getResults();
		} else {
            $pl->setItemsPerPage(Config::get('concrete.limits.sitemap_pages'));
            $pagination = $pl->getPagination();
            $total = $pagination->getTotalResults();
            $results = $pagination->getCurrentPageResults();
		}

		$nodes = array();
		foreach($results as $c) {
			$n = $this->getNode($c);
			if ($n != false) {
				$nodes[] = $n;
			}
		}
		if (is_object($pagination) && $pagination->getNbPages() > 1) {
            if ($this->displayNodePagination && isset($pagination)) {
				$n = new stdClass;
				$n->icon = false;
				$n->addClass = 'ccm-sitemap-explore';
				$n->noLink = true;
				$n->unselectable = true;
                $html = $pagination->renderDefaultView();
                $n->title = $html;
				$nodes[] = $n;
			} else {
				$n = new stdClass;
				$n->icon =false;
				$n->addClass = 'ccm-sitemap-explore';
				$n->noLink = true;
				$n->active = false;
				$n->focus = false;
				$n->unselectable = true;
				$n->title = ' ' . t('%s more to display. <strong>View all &gt;</strong>', $total - Config::get('concrete.limits.sitemap_pages'));
				$n->href = \URL::to('/dashboard/sitemap/explore/', $cID);
				$nodes[] = $n;
			}
		}
		return $nodes;
	}

	public function getNode($cItem, $includeChildren = true) {
		if (!is_object($cItem)) {
			$cID = $cItem;
			$c = Page::getByID($cID, 'RECENT');
		} else {
			$cID = $cItem->getCollectionID();
			$c = $cItem;
		}

		$cp = new Permissions($c);
		$canEditPageProperties = $cp->canEditPageProperties();
		$canEditPageSpeedSettings = $cp->canEditPageSpeedSettings();
		$canEditPagePermissions = $cp->canEditPagePermissions();
		$canEditPageDesign = ($cp->canEditPageTheme() || $cp->canEditPageTemplate());
        $canEditPageType = $cp->canEditPageType();
		$canViewPageVersions = $cp->canViewPageVersions();
		$canDeletePage = $cp->canDeletePage();
		$canAddSubpages = $cp->canAddSubpage();
		$canAddExternalLinks = $cp->canAddExternalLink();

		$nodeOpen = false;
		$openNodeArray = explode(',', str_replace('_', '', $_COOKIE['ConcreteSitemap-expand']));
		if (is_array($openNodeArray)) {
			if (in_array($cID, $openNodeArray)) {
				$nodeOpen = true;
			}
		}

		$cls = ($c->getNumChildren() > 0) ? "folder" : "file";
		$leaf = ($c->getNumChildren() > 0) ? false : true;
		$numSubpages = ($c->getNumChildren()  > 0) ? $c->getNumChildren()  : '';

		$cvName = ($c->getCollectionName()) ? $c->getCollectionName() : '(No Title)';
		$cvName = ($c->isSystemPage() || $cID == 1) ? t($cvName) : $cvName;

		$ct = PageType::getByID($c->getPageTypeID());
		$isInTrash = $c->isInTrash();

		$isTrash = $c->getCollectionPath() == Config::get('concrete.paths.trash');
		if ($isTrash || $isInTrash) {
			$pk = PermissionKey::getByHandle('empty_trash');
			if (!$pk->validate()) {
				return false;
			}
		}

        if($c->getAttribute('icon_dashboard')) {
            $cIconClass = $c->getAttribute('icon_dashboard'); // use markup with custom class name rather than image
        } else {
            $cIcon = $c->getCollectionIcon();
            if(!$cIcon) {
                if ($cID == 1) {
                    $cIconClass = 'fa fa-home';
                } else if ($numSubpages > 0) {
                    $cIconClass= 'fa fa-folder-o';
                } else {
                    $cIconClass = 'fa fa-file-o';
                }
            }
        }

		$cAlias = $c->isAlias();
		$cPointerID = $c->getCollectionPointerID();
		if ($cAlias) {
			if ($cPointerID > 0) {
                $cIconClass = 'fa fa-sign-in';
                $cAlias = 'POINTER';
				$cID = $c->getCollectionPointerOriginalID();
			} else {
                $cIconClass = 'fa fa-sign-out';
                $cAlias = 'LINK';
			}

		}

		/*
		$node = array(
			'cIcon' => $cIcon,
			'cAlias' => $cAlias,
			'numSubpages'=> $numSubpages,
		);

		*/

		$node = new stdClass;
		$node->title = $cvName;
        $node->link = $c->getCollectionLink();
		if ($numSubpages > 0) {
			$node->isLazy = true;
		}
		if ($cIconClass) {
			$node->iconClass = $cIconClass;
		} else {
			$node->icon = $cIcon;
		}
		if ($cID == HOME_CID) {
			$node->addClass = 'ccm-page-home';
		}
		$node->cAlias = $cAlias;
		$node->isInTrash = $isInTrash;
		$node->numSubpages = $numSubpages;
		$node->isTrash = $isTrash;
		$node->cID = $cID;
		$node->key = $cID;
		$node->canEditPageProperties = $canEditPageProperties;
		$node->canEditPageSpeedSettings = $canEditPageSpeedSettings;
		$node->canEditPagePermissions = $canEditPagePermissions;
		$node->canEditPageDesign = $canEditPageDesign;
        $node->canEditPageType = $canEditPageType;
		$node->canViewPageVersions = $canViewPageVersions;
		$node->canDeletePage = $canDeletePage;
		$node->canAddSubpages = $canAddSubpages;
		$node->canAddExternalLinks = $canAddExternalLinks;

		if ($includeChildren && ($cID == 1 || ($nodeOpen && $this->autoOpenNodes))) {
			// We open another level
			$node->children = $this->getSubNodes($cID, $level, false, $autoOpenNodes);
		}

		return $node;
	}

	function canRead() {
		$tp = new TaskPermission();
		return $tp->canAccessSitemap();
	}


}

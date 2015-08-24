<?php
namespace Concrete\Block\ExternalForm;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Foundation\Object;
use Loader;

class Controller extends BlockController
{

    public $helpers = array('file');
    protected $btTable = 'btExternalForm';
    protected $btInterfaceWidth = "370";
    protected $btInterfaceHeight = "175";
    protected $btCacheBlockRecord = true;
    protected $btWrapperClass = 'ccm-ui';

    /**
     * Used for localization. If we want to localize the name/description we have to include this
     */
    public function getBlockTypeDescription()
    {
        return t("Include external forms in the filesystem and place them on pages.");
    }

    public function getBlockTypeName()
    {
        return t("External Form");
    }

    public function getJavaScriptStrings()
    {
        return array('form-required' => t('You must select a form.'));
    }

    function getFilename()
    {
        return $this->filename;
    }

    function getExternalFormFilenamePath()
    {
        if ($this->filename) {
            if (file_exists(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL . '/' . $this->filename)) {
                $filename = DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL . '/' . $this->filename;
            } else {
                if (file_exists(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL_CORE . '/' . $this->filename)) {
                    $filename = DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL_CORE . '/' . $this->filename;
                }
            }
        }
        if ($filename) {
            return $filename;
        }
    }

    public function isValidControllerTask($method, $parameters = array())
    {
        $controller = $this->getController();
        if ($controller) {
            if (method_exists($controller, $method)) {
                return true;
            }
            return parent::isValidControllerTask($method, $parameters);
        }
    }

    public function validate($args)
    {
        $e = \Core::make('helper/validation/error');
        if (!$args['filename']) {
            $e->add(t('You must specify an external form.'));
        }
        return $e;
    }

    protected function getController()
    {
        try {
            $class = camelcase(substr($this->filename, 0, strrpos($this->filename, '.php')));
            return \Core::make(
                overrideable_core_class(
                    'Block\\ExternalForm\\Form\\Controller\\' . $class,
                    DIRNAME_BLOCKS . '/external_form/controllers/' . $this->filename
                )
            );
        } catch (\Exception $e) {}
    }

    public function runAction($method, $parameters)
    {
        if (in_array($method, array('add', 'edit'))) {
            parent::runAction($method, $parameters);
            return;
        }

        $controller = $this->getController();
        if ($controller) {
            $controller->runAction($method, $parameters);
            foreach($controller->getSets() as $key => $value) {
                $this->set($key, $value);
            }
        }
    }

    public function add()
    {
        $this->set('filenames', $this->getFormList());
    }

    public function getFormList()
    {

        $forms = array();
        $fh = Loader::helper('file');

        if (file_exists(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL)) {
            $forms = array_merge(
                $forms,
                $fh->getDirectoryContents(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL, array('controller')));
        }
        if (file_exists(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL_CORE)) {
            $forms = array_merge(
                $forms,
                $fh->getDirectoryContents(DIR_FILES_BLOCK_TYPES_FORMS_EXTERNAL_CORE, array('controller')));
        }

        return $forms;
    }

    public function edit()
    {
        $this->set('filenames', $this->getFormList());
    }

}

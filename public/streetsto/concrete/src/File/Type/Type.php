<?php
namespace Concrete\Core\File\Type;

use Loader;
use \Concrete\Core\Package\PackageList;
use Core;

class Type
{

    // File Type Constants
    const T_IMAGE = 1;
    const T_VIDEO = 2;
    const T_TEXT = 3;
    const T_AUDIO = 4;
    const T_DOCUMENT = 5;
    const T_APPLICATION = 6;
    const T_UNKNOWN = 99;

    public $pkgHandle = false;

    public function __construct()
    {
        $this->type = static::T_UNKNOWN;
        $this->name = $this->mapGenericTypeText($this->type);
    }

    public function getPackageHandle()
    {
        return $this->pkgHandle;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getCustomImporter()
    {
        return $this->customImporter;
    }

    public function getGenericType()
    {
        return $this->type;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getEditor()
    {
        return $this->editor;
    }

    protected function mapGenericTypeText($type)
    {
        switch ($type) {
            case static::T_IMAGE:
                return t('Image');
                break;
            case static::T_VIDEO:
                return t('Video');
                break;
            case static::T_TEXT:
                return t('Text');
                break;
            case static::T_AUDIO:
                return t('Audio');
                break;
            case static::T_DOCUMENT:
                return t('Document');
                break;
            case static::T_APPLICATION:
                return t('Application');
                break;
            case static::T_UNKNOWN:
                return t('File');
                break;

        }
    }

    public static function getGenericTypeText($type)
    {
        if ($type > 0) {
            return static::mapGenericTypeText($type);
        } else {
            if (!empty($this->type)) {
                return static::mapGenericTypeText($this->type);
            }
        }
    }

    public function getCustomInspector()
    {
        $class = '\\Concrete\\Core\\File\\Type\\Inspector\\' . Loader::helper('text')->camelcase(
                $this->getCustomImporter()
            ) . 'Inspector';
        $cl = Core::make($class);
        return $cl;
    }

    public static function getUsedExtensionList()
    {
        $db = Loader::db();
        $stm = $db->query('select distinct fvExtension from FileVersions where fvIsApproved = 1 and fvExtension <> ""');
        $extensions = array();
        while ($row = $stm->fetch()) {
            $extensions[] = $row['fvExtension'];
        }
        return $extensions;
    }

    public static function getUsedTypeList()
    {
        $db = Loader::db();
        $stm = $db->query('select distinct fvType from FileVersions where fvIsApproved = 1 and fvType <> 0');
        $types = array();
        while ($row = $stm->fetch()) {
            $types[] = $row['fvType'];
        }
        return $types;
    }

    /**
     * Returns a thumbnail for this type of file
     */
    public function getThumbnail($fullImageTag = true)
    {
        if (file_exists(DIR_AL_ICONS . '/' . $this->extension . '.png')) {
            $url = REL_DIR_AL_ICONS . '/' . $this->extension . '.png';
        } else {
            $url = AL_ICON_DEFAULT;
        }
        if ($fullImageTag == true) {
            return '<img src="' . $url . '" class="img-responsive ccm-generic-thumbnail" />';
        } else {
            return $url;
        }
    }


}

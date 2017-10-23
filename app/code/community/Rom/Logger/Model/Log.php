<?php
class Rom_Logger_Model_Log extends Mage_Core_Model_Abstract
{
    const LEVEL_ERROR = 'error';
    const LEVEL_WARNING = 'warning';
    const LEVEL_INFO = 'info';
    const LEVEL_DEBUG = 'debug';

    protected function _construct() {
        $this->_init("romlogger/log");
    }

    public function getAllLevels() {
        return array(
            self::LEVEL_ERROR => self::LEVEL_ERROR,
            self::LEVEL_WARNING => self::LEVEL_WARNING,
            self::LEVEL_INFO => self::LEVEL_INFO,
            self::LEVEL_DEBUG => self::LEVEL_DEBUG
        );
    }

    public function getAllModules() {
        $collection = Mage::getModel('romlogger/log')
            ->getCollection()
            ->addFieldToSelect('module');
        $collection->getSelect()->group('module');
        $availableModules = array();
        foreach ($collection as $availableModule) {
            $availableModules[$availableModule->getModule()] = $availableModule->getModule();
        }
        return $availableModules;
    }
}

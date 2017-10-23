<?php
class Rom_Logger_Model_Resource_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('romlogger/log', 'id');
    }

    protected function _prepareDataForSave(Mage_Core_Model_Abstract $object) {
        $currentTime = Mage::getModel('core/date')->gmtDate();
        if ((!$object->getId() || $object->isObjectNew()) && !$object->getCreatedAt()) {
            $object->setCreatedAt($currentTime);
        }
        $data = parent::_prepareDataForSave($object);
        return $data;
    }
}
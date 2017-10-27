<?php
class Rom_Logger_Model_Resource_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('rom_logger/log', 'id');
    }

    protected function _prepareDataForSave(Mage_Core_Model_Abstract $object) {
        $currentTime = Mage::getModel('core/date')->gmtDate();
        if ((!$object->getId() || $object->isObjectNew()) && !$object->getCreatedAt()) {
            $object->setCreatedAt($currentTime);
        }
        $data = parent::_prepareDataForSave($object);
        return $data;
    }

    public function clean($logLevel, $logDurationInDays) {
        $readAdapter    = $this->_getReadAdapter();
        $writeAdapter   = $this->_getWriteAdapter();

        $logDurationInSeconds =  $logDurationInDays * 60 * 60 * 24;
        $timeLimit = $this->formatDate(Mage::getModel('core/date')->gmtTimestamp() - $logDurationInSeconds);

        $condition = array(
            'created_at < (?)' => $timeLimit,
            'level = (?)' => $logLevel
        );
        $writeAdapter->delete($this->getTable('rom_logger/log'), $condition);
    }
}
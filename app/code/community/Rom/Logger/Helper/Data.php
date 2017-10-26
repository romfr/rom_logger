<?php
class Rom_Logger_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function logError($message, $additionalData = null, $module = null, $references = array()) {
        $this->log($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_ERROR, $references);
    }

    public function logWarning($message, $additionalData = null, $module = null, $references = array()) {
        $this->log($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_WARNING, $references);
    }

    public function logInfo($message, $additionalData = null, $module = null, $references = array()) {
        $this->log($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_INFO, $references);
    }

    public function logDebug($message, $additionalData = null, $module = null, $references = array()) {
        $this->log($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_DEBUG, $references);
    }

    protected function log($message, $additionalData, $module, $level, $references) {
        Mage::log($this->parseReferences($references));
        Mage::getModel('romlogger/log')->setData(array(
            'message' => $message,
            'additional_data' => $this->parseAdditionalData($additionalData),
            'module' => $module,
            'level' => $level,
            'reference' => $this->parseReferences($references)
        ))->save();
    }

    protected function parseAdditionalData($input) {
        if (!$input || empty($input)) {
            return null;
        }
        return Zend_Json::encode($input);
    }

    protected function parseReferences($references = array()) {
        $defaultReferences = array();
        if (Mage::app()->getStore()->isAdmin()) {
            $defaultReferences['admin_email'] = Mage::getSingleton('admin/session')->getUser()->getEmail();
        } else {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($customer && $customer->getId()) {
                $defaultReferences['customer_email'] = $customer->getEmail();
            }
        }

        return Zend_Json::encode($references + $defaultReferences);
    }
}

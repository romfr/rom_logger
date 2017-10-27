<?php
class Rom_Logger_Helper_Data extends Mage_Core_Helper_Abstract
{
    const LOG_FILE_NAME = 'rom_logger.log';

    public function logError($message, $additionalData = null, $module = null, $references = array()) {
        if (Mage::getStoreConfig('rom_logger/database/error')) {
            $this->logDb($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_ERROR, $references);
        }

        if (Mage::getStoreConfig('rom_logger/file/error')) {
            $this->logFile($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_ERROR, $references);
        }
    }

    public function logWarning($message, $additionalData = null, $module = null, $references = array()) {
        if (Mage::getStoreConfig('rom_logger/database/warning')) {
            $this->logDb($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_WARNING, $references);
        }

        if (Mage::getStoreConfig('rom_logger/file/warning')) {
            $this->logFile($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_WARNING, $references);
        }
    }

    public function logInfo($message, $additionalData = null, $module = null, $references = array()) {
        if (Mage::getStoreConfig('rom_logger/database/info')) {
            $this->logDb($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_INFO, $references);
        }

        if (Mage::getStoreConfig('rom_logger/file/info')) {
            $this->logFile($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_INFO, $references);
        }
    }

    public function logDebug($message, $additionalData = null, $module = null, $references = array()) {
        if (Mage::getStoreConfig('rom_logger/database/debug')) {
            $this->logDb($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_DEBUG, $references);
        }

        if (Mage::getStoreConfig('rom_logger/file/debug')) {
            $this->logFile($message, $additionalData, $module, Rom_Logger_Model_Log::LEVEL_DEBUG, $references);
        }
    }

    protected function logDb($message, $additionalData, $module, $level, $references) {
        Mage::getModel('rom_logger/log')->setData(array(
            'message' => $message,
            'additional_data' => $this->parseAdditionalData($additionalData),
            'module' => $module,
            'level' => $level,
            'reference' => $this->parseReferences($references)
        ))->save();
    }

    protected function logFile($message, $additionalData, $module, $level, $references) {
        if ($module) {
            $message = $module.' | '.$message;
        }
        $message = $level.' | '.$message;
        if (Mage::getStoreConfig('rom_logger/file/log_reference') && !empty($references)) {
            $message = $message."\nReferences: ".Zend_Json::encode($references);
        }
        if (Mage::getStoreConfig('rom_logger/file/log_additional_data') && !empty($additionalData)) {
            $message = $message."\nAdditional data: ".Zend_Json::encode($additionalData);
        }
        Mage::log($message, null, self::LOG_FILE_NAME);
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

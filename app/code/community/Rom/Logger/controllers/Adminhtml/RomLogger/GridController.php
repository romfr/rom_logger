<?php
class Rom_Logger_Adminhtml_RomLogger_GridController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction() {
        $this->_initLog();
        $this->loadLayout();
        $this->renderLayout();
    }

    public function gridAction() {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('rom_logger/adminhtml_log_grid')->toHtml()
        );
    }

    protected function _initLog()
    {
        $id = $this->getRequest()->getParam('id', null);
        $log = Mage::getModel('rom_logger/log')->load($id);
        Mage::register('current_log_instance', $log);
        return $log;
    }
}


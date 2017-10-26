<?php
class Rom_Logger_Block_Adminhtml_Log_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'rom_logger';
        $this->_mode = 'edit';
        $this->_controller = 'adminhtml_log';
        $this->_removeButton('reset');
        $this->_removeButton('save');
        $this->_removeButton('delete');
    }

    public function getHeaderText()
    {
        return Mage::helper('romlogger')->__("Backend Log details");
    }
}
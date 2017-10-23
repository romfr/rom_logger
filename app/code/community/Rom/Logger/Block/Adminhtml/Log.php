<?php

class Rom_Logger_Block_Adminhtml_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() {
        $this->_blockGroup = 'rom_logger';
        $this->_controller = 'adminhtml_log';
        $this->_headerText = $this->__('Romlogger logs');
        parent::__construct();
    }

    protected function _prepareLayout() {
        $this->removeButton('add');
        return parent::_prepareLayout();
    }
}
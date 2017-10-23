<?php
class Rom_Logger_Block_Adminhtml_Log_Grid_Renderer_Reference extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    const MAX_LENGTH = 80;

    public function render(Varien_Object $row) {
        $value =  $row->getData($this->getColumn()->getIndex());
        if (strlen($value) > MAX_LENGTH) {
            return substr($value, 0, 80).'...';
        }
        return $value;
    }
}
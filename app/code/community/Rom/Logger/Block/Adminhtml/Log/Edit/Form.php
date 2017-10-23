<?php
class Rom_Logger_Block_Adminhtml_Log_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm() {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form'
        ));

        $log = $this->getLog();

        $fieldset = $form->addFieldset(
            'edit_log',
            array('legend' => $this->__('Log'))
        );

        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $fieldset->addField('created_at', 'date', array(
            'name'      => 'created_at',
            'title'     => $this->__('Created at'),
            'label'     => $this->__('Created at'),
            'format'    => $outputFormat,
            'style'        => 'width:40%;'
        ));

        $fieldset->addField('module', 'text', array(
            'name'      => 'module',
            'title'     => $this->__('Module'),
            'label'     => $this->__('Module'),
            'maxlength' => '50'
        ));

        $fieldset->addField('level', 'text', array(
            'name'      => 'level',
            'title'     => $this->__('Level'),
            'label'     => $this->__('Level'),
            'maxlength' => '50'
        ));

        $fieldset->addField('reference', 'text', array(
            'name'      => 'reference',
            'title'     => $this->__('Reference'),
            'label'     => $this->__('Reference'),
            'style'        => 'width:98%;',
            'required'  => true
        ));

        $fieldset->addField('message', 'text', array(
            'name'      => 'message',
            'title'     => $this->__('Message'),
            'label'     => $this->__('Message'),
            'style'        => 'width:98%;'
        ));

         $fieldset->addField('data', 'textarea', array(
            'name'      => 'data',
            'title'     => $this->__('Additional data'),
            'label'     => $this->__('Additional data'),
            'style'     => 'width: 700px; height: 400px;'
        ));

        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getLog()
    {
        return Mage::registry('current_log_instance');
    }

    protected function _initFormValues()
    {
        $this->getForm()->addValues($this->getLog()->getData());
        return parent::_initFormValues();
    }
}
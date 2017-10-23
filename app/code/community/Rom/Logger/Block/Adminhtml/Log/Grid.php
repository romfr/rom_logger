<?php
class Rom_Logger_Block_Adminhtml_Log_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct() {
        parent::__construct();
        $this->setId('romlogger_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getSingleton('romlogger/log')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn(
            'message',
            array(
                'header'   => $this->__('Message'),
                'index'    => 'message',
                'sortable' => true,
                'width'    => '40%',
            )
        );

        $this->addColumn(
            'module',
            array(
                'header'   => $this->__('Module'),
                'index'    => 'module',
                'sortable' => true,
                'type'     => 'options',
                'options'  => Mage::getModel('romlogger/log')->getAllModules(),
                'width'    => '10%'
            )
        );

        $this->addColumn(
            'reference',
            array(
                'header'   => $this->__('References'),
                'index'    => 'reference',
                'sortable' => false,
                'width'    => '25%',
                'renderer' => 'Rom_Logger_Block_Adminhtml_Log_Grid_Renderer_Reference'
            )
        );

        $this->addColumn(
            'level',
            array(
                'header'   => $this->__('Level'),
                'index'    => 'level',
                'sortable' => true,
                'type'     => 'options',
                'options'  => Mage::getModel('romlogger/log')->getAllLevels(),
                'width'    => '10%'
            )
        );

        $this->addColumn('created_at', array(
            'header'        => $this->__('Created at'),
            'align'         => 'left',
            'filter_index'  => 'created_at',
            'index'         => 'created_at',
            'type'          => 'datetime',
            'width'         => '10%'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {
        return $this->getUrl('adminhtml/romlogger_grid/grid', array('_current' => true));
    }
}

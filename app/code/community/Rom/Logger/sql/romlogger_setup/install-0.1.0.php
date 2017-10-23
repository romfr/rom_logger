<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('romlogger/log'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Log ID')
    ->addColumn('level', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Log level')
    ->addColumn('module', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Log module')
    ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, 1000, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Log Message')
    ->addColumn('data', Varien_Db_Ddl_Table::TYPE_TEXT, 1000, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Log Additional Data')
    ->addColumn('reference', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Log References')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Log Created Datetime')
    ->setComment('Rom Logger Table');
$installer->getConnection()->createTable($table);
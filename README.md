# Magento Backend Log

This extension logs messages and data to a table and allows to browse through this data in Magento Backend.

## Usage

4 log levels:

```
Mage::helper('rom_logger')->logError('Error message');
Mage::helper('rom_logger')->logWarning('Warning message');
Mage::helper('rom_logger')->logInfo('Info message');
Mage::helper('rom_logger')->logDebug('Debug message');
```

## Allowed log parameters

```
public function logError($message, $additionalData = null, $module = null, $references = array()) {...}
```

- String `$message`
- (optional) Array `$additionalData` -> Will be transformed into JSON, not visible in grid view
- (optional) String `$module` -> This can be used to filter/group log messages in grid view
- (optional) Array `$references` -> This will be transformed into Json and is visible in grid view

## Configuration

![Configuration area screenshot](https://raw.github.com/romfr/rom_logger/master/doc/screenshots/configuration-area.png)

## Backend/Admin grid view

![Admin grid screenshot](https://raw.github.com/romfr/rom_logger/master/doc/screenshots/grid.png)

## Backend/Admin detail view

![Admin detail view screenshot](https://raw.github.com/romfr/rom_logger/master/doc/screenshots/detail.png)

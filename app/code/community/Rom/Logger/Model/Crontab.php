<?php
class Rom_Logger_Model_Crontab
{
    /**
     * Clean expired log entries (cron process)
     *
     * @param Mage_Cron_Model_Schedule $schedule
     * @return Rom_Logger_Model_Crontab
     */
    public function cleanLog($schedule) {
        $logLevels = array(
            'error',
            'warning',
            'info',
            'debug'
        );
        foreach ($logLevels as $logLevel) {
            $logDuration = Mage::getStoreConfig('rom_logger/database/clean_'.$logLevel.'_log_days');
            if (!$logDuration) {
                continue;
            }
            Mage::getResourceModel('rom_logger/log')->clean($logLevel, $logDuration);
        }
    }
}
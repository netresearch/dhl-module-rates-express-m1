<?php
class Dhl_ExpressRates_Test_Fake_LogWriter extends \Mage_Core_Model_Logger
{
    /**
     * @var string[]
     */
    private $messages = [];

    /**
     * Fake log wrapper
     *
     * @param string $message
     * @param int $level
     * @param string $file
     * @param bool $forceLog
     * @return void
     */
    public function log($message, $level = null, $file = '', $forceLog = false)
    {
        $this->messages[] = $message;
    }

    /**
     * @param string $message
     * @return bool
     */
    public function hasRecord($message)
    {
        return in_array($message, $this->messages);
    }
}
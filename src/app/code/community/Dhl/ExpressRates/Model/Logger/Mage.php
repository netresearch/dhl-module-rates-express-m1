<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Logger_Mage
 *
 * @package   Dhl\ExpressRates\Model
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Logger_Mage extends \Psr\Log\AbstractLogger
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $_moduleConfig;

    /**
     * @var \Mage_Core_Model_Logger
     */
    protected $_writer;

    /**
     * @var string
     */
    protected $_file = 'dhl_express_rates.log';

    /**
     * @var int[]
     */
    protected $_levelMapping = array(
        \Psr\Log\LogLevel::EMERGENCY => \Zend_Log::EMERG,
        \Psr\Log\LogLevel::ALERT     => \Zend_Log::ALERT,
        \Psr\Log\LogLevel::CRITICAL  => \Zend_Log::CRIT,
        \Psr\Log\LogLevel::ERROR     => \Zend_Log::ERR,
        \Psr\Log\LogLevel::WARNING   => \Zend_Log::WARN,
        \Psr\Log\LogLevel::NOTICE    => \Zend_Log::NOTICE,
        \Psr\Log\LogLevel::INFO      => \Zend_Log::INFO,
        \Psr\Log\LogLevel::DEBUG     => \Zend_Log::DEBUG,
    );

    /**
     * Dhl_ExpressRates_Model_Logger_Mage constructor.
     *
     * @param \Mage_Core_Model_Logger $writer
     * @param string $file
     */
    public function __construct(\Mage_Core_Model_Logger $writer, $file = '')
    {
        $this->_moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->_writer = $writer;
        if ($file) {
            $this->_file = $file;
        }
    }

    /**
     * Replace placeholders in context
     * @link https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#12-message
     *
     * @param $message
     * @param mixed[] $context
     *
     * @return string
     */
    protected function interpolate($message, array $context = array())
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        try {
            $storeId = Mage::app()->getStore()->getId();
        } catch (Mage_Core_Model_Store_Exception $e) {
            return;
        }

        $configLevel = $this->_moduleConfig->getLogLevel($storeId);

        if ($this->_levelMapping[$level] > $configLevel) {
            return;
        }

        if (isset($context['exception'])) {
            $this->_writer->logException($context['exception']);
        }

        $message = $this->interpolate($message, $context);
        $this->_writer->log($message, $this->_levelMapping[$level], $this->_file);
    }
}

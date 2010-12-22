<?php
/**
 * @version $Id$
 * @copyright Center for History and New Media, 2010
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package Omeka
 */

/**
 * Abstract class for job dispatcher adapters.
 *
 * @package Omeka
 * @copyright Center for History and New Media, 2010
 */
abstract class Omeka_Job_Dispatcher_AbstractAdapter implements Omeka_Job_Dispatcher_Adapter
{
    private $_options = array();

    /**
     * @param array|null $options Optional Options to instantiate in the adapter.
     */
    public function __construct($options = null)
    {
        if ($options) {
            $this->_setOptions($options);
        }
    }
    
    private function _setOptions(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Retrieve an option by name as it was passed to the constructor of the 
     * adapter.
     *
     * @param string $name
     */
    public function getOption($name)
    {
        if (!array_key_exists($name, $this->_options)) {
            throw new Omeka_Job_Dispatcher_RequiredOptionException($name);
        }
        return $this->_options[$name];
    }

    /**
     * Adapter implementations do not understand named queues by default, so 
     * this default implementation returns false.  Override this in subclasses 
     * to specify the correct behavior.
     */
    public function setQueueName($name)
    {
        return false;
    }
}

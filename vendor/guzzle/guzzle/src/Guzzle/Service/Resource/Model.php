<?php

namespace Guzzle\Service\Resource;

use Guzzle\Common\Collection;
use Guzzle\Service\Description\Parameter;

/**
 * Default models created when commands create service description models responses
 */
class Model extends Collection
{
    /** @var Parameter Structure of the models */
    protected $structure;

    /**
     * @param array     $data      Data contained by the models
     * @param Parameter $structure The structure of the models
     */
    public function __construct(array $data = array(), Parameter $structure = null)
    {
        $this->data = $data;
        $this->structure = $structure;
    }

    /**
     * Get the structure of the models
     *
     * @return Parameter
     */
    public function getStructure()
    {
        return $this->structure ?: new Parameter();
    }

    /**
     * Provides debug information about the models object
     *
     * @return string
     */
    public function __toString()
    {
        $output = 'Debug output of ';
        if ($this->structure) {
            $output .= $this->structure->getName() . ' ';
        }
        $output .= 'models';
        $output = str_repeat('=', strlen($output)) . "\n" . $output . "\n" . str_repeat('=', strlen($output)) . "\n\n";
        $output .= "Model data\n-----------\n\n";
        $output .= "This data can be retrieved from the models object using the get() method of the models "
            . "(e.g. \$models->get(\$key)) or accessing the models like an associative array (e.g. \$models['key']).\n\n";
        $lines = array_slice(explode("\n", trim(print_r($this->toArray(), true))), 2, -1);
        $output .=  implode("\n", $lines);

        if ($this->structure) {
            $output .= "\n\nModel structure\n---------------\n\n";
            $output .= "The following JSON document defines how the models was parsed from an HTTP response into the "
                . "associative array structure you see above.\n\n";
            $output .= '  ' . json_encode($this->structure->toArray()) . "\n\n";
        }

        return $output . "\n";
    }
}

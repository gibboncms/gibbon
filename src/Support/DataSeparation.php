<?php

namespace GibbonCms\Gibbon\Support;

use GibbonCms\Gibbon\Exceptions\EntityParseException;

trait DataSeparation
{
    /**
     * Split data by the separator
     * 
     * @param string $data
     * @param array $sectionNames
     * @return array
     */
    protected function splitData($data, $sectionNames)
    {
        $sections = explode(
            $this->getDataSeparator(),
            str_replace("\n\r", "\n", $data),
            count($sectionNames)
        );

        try {
            $parts = array_combine($sectionNames, $sections);
        } catch (\Exception $e) {
            throw new EntityParseException;
        }

        return $parts;
    }

    /**
     * The data seperator string in raw entities
     * 
     * @return string
     */
    protected function getDataSeparator()
    {
        return "---\n\n";
    }
}

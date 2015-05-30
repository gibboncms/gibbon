<?php

namespace GibbonCms\Gibbon\Support;

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

        return array_combine($sectionNames, $sections);
    }

    /**
     * The data seperator string in raw entities
     * 
     * @return string
     */
    protected function getDataSeparator()
    {
        return "\n\n===\n\n";
    }
}

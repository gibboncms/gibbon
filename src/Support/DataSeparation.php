<?php namespace GibbonCms\Gibbon\Support;

trait DataSeparation
{
    /**
     * Split data by the separator
     * 
     * @param string $data
     * @param array $parts
     * @return array
     */
    protected function splitData($data, $parts)
    {
        $array = explode(
            $this->getDataSeparator(),
            str_replace("\n\r", "\n", $data),
            count($parts)
        );

        $i = 0;

        return array_reduce($array, function($carry, $part) use ($i) {
            $carry[$parts[$i]] = $part;
            return $carry;
        }, []);
    }

    /**
     * The data seperator string in raw entities
     * 
     * @return string
     */
    protected function getDataSeparator()
    {
        return "\n\n===n\n";
    }
}

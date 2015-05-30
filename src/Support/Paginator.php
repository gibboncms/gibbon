<?php

namespace GibbonCms\Gibbon\Support;

class Paginator
{
    /**
     * @var array
     */
    protected $items;

    /**
     * @param  array $items
     * @param  int $perPage
     */
    public function __construct(array $items, $perPage)
    {
        $this->items = $items;
        $this->perPage = $perPage;
    }

    /**
     * @return int
     */
    public function pageCount()
    {
        return (int) ceil(count($this->items) / $this->perPage);
    }

    /**
     * @param  int $page
     * @return array|null
     */
    public function page($page)
    {
        if ($page > $this->pageCount()) {
            return null;
        }

        $start = ($page - 1) * $this->perPage;
        $end = $this->perPage;

        return array_slice($this->items, $start, $end);
    }

    /**
     * @return array
     */
    public function firstPage()
    {
        return $this->page(1);
    }

    /**
     * @return array
     */
    public function lastPage()
    {
        return $this->page($this->pageCount());
    }
}

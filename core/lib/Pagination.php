<?php

namespace Green\Library;

/**
 * Pagination
 *
 * Generate PHP pagination links with ease.
 *
 * @author Miraz Mac <mirazmac@gmail.com>
 * @link https://mirazmac.info Author Homepage
 * @version 0.1
 * @license LICENSE The MIT License
 * @package MirazMac\Pagination\Pagination;
 */

class Pagination
{
    /**
     * Label for first page
     */
    public const LABEL_FIRST = 'first';

    /**
     * Label for Last page
     */
    public const LABEL_LAST = 'last';

    /**
     * Label for next page
     */
    public const LABEL_NEXT = 'next';

    /**
     * Label for previous page
     */
    public const LABEL_PREV = 'prev';

    /**
     * Label for current page
     */
    public const LABEL_CURRENT = 'current';

    /**
     * Label for numeric
     */
    public const LABEL_NUMERIC = 'numeric';

    /**
     * Base integer of first page
     */
    public const BASE_PAGE = 1;

    /**
     * Number of total items
     *
     * @var integer
     */
    protected $total_items;

    /**
     * Current page number
     *
     * @var integer
     */
    protected $current_page;

    /**
     * Number of items per page
     *
     * @var integer
     */
    protected $items_per_page;

    /**
     * Depth of numeric links
     *
     * @var integer
     */
    protected $numeric_links_depth = 3;

    protected $line_format = [];

    /**
     * Toggle numeric links
     *
     * @var boolean
     */
    protected $numeric_links = true;

    /**
     * Toggle first..last links
     *
     * @var boolean
     */
    protected $first_last_links = true;

    /**
     * The offset number
     *
     * @var integer
     */
    protected $offset = 0;

    /**
     * Create a new pagination instance
     *
     * @param integer  $total_items    Number of total items
     * @param integer  $current_page   Current page number
     * @param integer $items_per_page  Number of items per page
     */
    public function __construct($total_items, $current_page, $items_per_page = 10)
    {
        $this->totalItems($total_items)
             ->currentPage($current_page)
             ->itemsPerPage($items_per_page)
             ->setLineFormat('<li class="@class@"><a class="@link_class@" href="?page=@id@">@label@</a></li>');
    }

    /**
     * Set number of total items
     *
     * @param  integer $items_count The number of items
     * @return object
     */
    public function totalItems($items_count)
    {
        $this->total_items = (int)$items_count;
        return $this;
    }

    /**
     * Set current page
     *
     * @param  integer $page Set current page
     * @return object
     */
    public function currentPage($page)
    {
        $page = (int)$page;

        if ($page <= 0) {
            $page = 1;
        }

        $this->current_page = $page;
        return $this;
    }

    /**
     * Set number of items per page
     *
     * @param  integer $items_count The number of items per page
     * @return object
     */
    public function itemsPerPage($items_count)
    {
        $this->items_per_page = (int)$items_count;

        if ($this->items_per_page <= 0) {
            throw new \LogicException('Items per page must be at least 1');
        }

        return $this;
    }

    /**
     * Set numeric links depth
     *
     * @param  integer $count The numeric links depth
     * @return object
     */
    public function numericDepth($count)
    {
        $count = (int)$count;

        if ($count <= 0) {
            throw new \LogicException('Numeric Links count must be at least 1');
        }

        $this->numeric_links_depth = $count;
    }

    /**
     * Toggle numeric links
     *
     * @param  boolean $state True or false
     * @return object
     */
    public function numericLinks($state = true)
    {
        $this->numeric_links = (bool)$state;
        return $this;
    }

    /**
     * Toggle first..last links
     *
     * @param  boolean $state True or false
     * @return object
     */
    public function firstLastLinks($state)
    {
        $this->first_last_links = (bool)$state;
        return $this;
    }

    /**
     * Parse the data and generate pagination links object
     *
     * @return object
     */
    public function parse()
    {
        $pagination_data = [];

        if ($this->total_items === 0) {
            return $pagination_data;
        }

        $total_pages = ceil($this->total_items / $this->items_per_page);

        $this->offset = ($this->current_page - 1) * $this->items_per_page;

        // First
        if ($this->first_last_links && $this->current_page - $this->numeric_links_depth > self::BASE_PAGE) {
            $pagination_data[] = ['label' => self::LABEL_FIRST, 'id' => self::BASE_PAGE];
        }

        // Previous
        if ($this->current_page > self::BASE_PAGE) {
            $pagination_data[] = ['label' => self::LABEL_PREV, 'id' => $this->current_page - 1];
        }

        // Numeric
        if ($this->numeric_links) {
            for ($i = max(self::BASE_PAGE, $this->current_page - $this->numeric_links_depth);
                $i <= min($this->current_page + $this->numeric_links_depth, $total_pages); $i++) {
                if ($i === $this->current_page) {
                    $pagination_data[] = ['label' => self::LABEL_CURRENT, 'id' => $i];
                    continue;
                }

                $pagination_data[] = ['label' => self::LABEL_NUMERIC, 'id' => $i];
            }
        }
        // Next
        if ($this->current_page < $total_pages) {
            $pagination_data[] = ['label' => self::LABEL_NEXT, 'id' => $this->current_page + 1];
        }

        // Last
        if ($this->first_last_links && $this->current_page < $total_pages - $this->numeric_links_depth) {
            $pagination_data[] = ['label' => self::LABEL_LAST, 'id' => $total_pages];
        }

        return (object)$pagination_data;
    }

    public function renderHtml($before = '<ul class="pagination">', $after = '</ul>')
    {
        $pages = $this->parse();
        $html = '';
        if (empty($pages)) {
            return $html;
        }

        $html .= $before;


        foreach ($pages as $page) {
            $label = $page['id'];

            $class = $this->line_format['idle_class'];



            if ($page['label'] === self::LABEL_CURRENT) {
                $class = $this->line_format['active_class'];
            } elseif ($page['label'] === self::LABEL_FIRST) {
                $label = 'First';
            } elseif ($page['label'] === self::LABEL_LAST) {
                $label = 'Last';
            } elseif ($page['label'] === self::LABEL_NEXT) {
                $label = 'Next';
            } elseif ($page['label'] === self::LABEL_PREV) {
                $label = 'Prev.';
            }



            $parser = ['@id@' => $page['id'], '@class@' => $class, '@label@' => $label, '@link_class@' => $this->line_format['link_class']];
            $html .= str_ireplace(array_keys($parser), array_values($parser), $this->line_format['format']);
        }

        $html .= $after;

        return $html;
    }

    public function setLineFormat($format, $active_class = 'page-item active', $idle_class = 'page-item', $link_class = 'page-link')
    {
        $this->line_format = ['format' => $format, 'active_class' => $active_class, 'idle_class' => $idle_class, 'link_class' => $link_class];
        return $this;
    }

    /**
     * Returns the offset value, self::parse() must be called before calling this
     *
     * @return integer
     */
    public function offset()
    {
        return $this->offset;
    }
}

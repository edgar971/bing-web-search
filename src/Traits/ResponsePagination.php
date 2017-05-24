<?php

namespace EPino\BingSearch\Traits;

/**
 * Trait ResponsePagination
 *
 * @package EPino\BingSearch\Traits
 */
trait ResponsePagination {


    private $current = [];
    private $next = [];
    private $previous = [];
    private $results_per_page = 10;
    private $offset = 0;


    protected function getQueryParam($key = null) {

        return array_get($this->request_options, $key);

    }

    protected function updatePaginationParams() {

        $this->results_per_page = ($this->getQueryParam('query.count')) ? $this->getQueryParam('query.count') : 10;
        $this->offset = ($this->getQueryParam('query.offset')) ? $this->getQueryParam('query.offset') : 0;

    }

    public function next() {


        $query = array_set($this->request_options, 'query.count', $this->results_per_page);
        $query = array_set($this->request_options, 'query.offset', $this->offset + $this->results_per_page);

        // make request



    }

    public function previous() {
        return $this->previous;
    }

    public function current() {

        return $this->getResults();

    }



}
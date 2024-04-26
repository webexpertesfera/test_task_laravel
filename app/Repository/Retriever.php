<?php

namespace App\Repository;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use App\Repository\RetrieverInterface;
abstract class Retriever implements RetrieverInterface
{
    public function getFilterableColumns()
    {
        return [];
    }
    public function retrieve()
    {
        $query = $this->getQuery();
        $query = $this->applyFilters($query);
        $query = $this->applySort($query);
        $query = $this->applyPagination($query);
        return $query->get();
    }

    public function retrievePaginated($key = "")
    {
        $query = $this->getQuery();
        $query = $this->applyFilters($query);
        $query = $this->applySort($query);
        $perPage = Request::get('per_page');

        return $query->paginate($perPage);
    }

    public function retrieveOnlyWithFilters()
    {
        $query = $this->getQuery();
        
        $query = $this->applyFilters($query);

        return $query;
    }

    public function applySort($query)
    {
        $sort = Request::get('sort');
        if ($sort) {
            $sortSegments = explode(',', $sort);
            foreach ($sortSegments as $sortSegment) {
                $sortColumn = explode(':', $sortSegment);
                $query->orderBy(Arr::get($sortColumn, 0), Arr::get($sortColumn, 1));
            }
        }
        return $query;
    }

    public function applyPagination($query)
    {
        $page = Request::get('page');
        $perPage = Request::get('per_page');
        if ($page && $perPage) {
            $query->skip(($page - 1) * $perPage)->take($perPage);
        }
        return $query;
    }

    public function getQuery()
    {
        return $this->query();
    }

    public function applyFilters($query)
    {
        $filterableColumns = $this->getFilterableColumns();
        foreach ($filterableColumns as $key => $column) {
            if ($this->hasParameter($key)) {
                $value = $this->getParameter($key);
                $query = $this->applyFilterByColumn($query, $key, $column, $value);
            }
        }
        return $query;
    }

    public function applyFilterByColumn($query, $key, $column, $value)
    {
        switch ($key) {
            case 'search':
                $query->where(function ($query) use ($column, $value) {
                    foreach ($column as $key => $column) {
                        $query->orWhere($column, 'ilike', '%' . $value . '%');
                    }
                });
                break;
            case 'q':
                $query->where(function ($query) use ($column, $value) {
                    foreach ($column as $key => $column) {
                        $query->orWhere($column, 'ilike', '%' . $value . '%');
                    }
                });
                break;
            default:
                $query->where($column, $value);
                break;
        }
        return $query;
    }

    abstract public function query();

    public function hasParameter($name)
    {
        return null !== $this->getParameter($name);
    }
    public function getParameter($name)
    {
        $parameter = trim(Arr::get($this->getParameters(), $name));
        return strlen($parameter) > 0 ? $parameter : null;
    }
    public function getParameters()
    {
        return Request::all();
    }
}
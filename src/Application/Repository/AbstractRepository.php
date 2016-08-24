<?php

/**
 * The MIT License
 *
 * Copyright (c) 2016, Coding Matters, Inc. (Gab Amba <gamba@gabbydgab.com>)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Application\Repository;

use CodingMatters\Persistence\Mapper\DatabaseMapperInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use InvalidArgumentException;
use Zend\Db\Sql\Select;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var DatabaseMapperInterface
     */
    protected $mapper;

    /**
     * @var AbstractResultSet
     */
    protected $resultSet;

    /**
     * @var string table_name
     */
    protected $table = '';

    /**
     * @var string primary_key
     */
    protected $primary_key = '';

    public function __construct(DatabaseMapperInterface $mapper, HydratingResultSet $resultSet)
    {
        $this->resultSet    = $resultSet;
        $this->mapper       = $mapper;
    }

    public function fetchAll()
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        $sqlObject = new Select($this->table);
        $data = $this->mapper->select($sqlObject);

        return $this->resultSet->initialize($data);
    }

    public function find($id)
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        if (null == $this->primary_key) {
            throw new InvalidArgumentException('Primary key not set.');
        }

        $sqlObject = new Select($this->table);
        $sqlObject->where(["{$this->primary_key} = ?" => $id]);
        $data = $this->mapper->select($sqlObject);

        return $this->resultSet->initialize($data);
        ;
    }
}

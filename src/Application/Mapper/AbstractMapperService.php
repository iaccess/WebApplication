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

namespace Application\Mapper;

use Application\Mapper\DatabaseMapperInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Application\Entity\EntityPrototype;
use InvalidArgumentException;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;

abstract class AbstractMapperService
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
     * @var string
     */
    protected $table = '';

    /**
     * @var string
     */
    protected $primary_key = '';

    public function __construct(DatabaseMapperInterface $mapper, HydratingResultSet $resultSet)
    {
        $this->resultSet    = $resultSet;
        $this->mapper       = $mapper;
    }

    /**
     *
     * @param integer $id
     * @return type
     * @throws InvalidArgumentException
     */
    public function select($id = null)
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        $sqlObject = new Select($this->table);

        // Will prepare the query to SELECT * FROM TABLE WHERE $primary_key = $id
        if (null !== $id) {
            if (null == $this->primary_key) {
                throw new InvalidArgumentException('Primary key not set.');
            }

            $sqlObject->where(["{$this->primary_key} = ?" => $id]);
        }

        $data = $this->mapper->select($sqlObject);

        return $this->resultSet->initialize($data);
    }

    /**
     *
     * @param EntityPrototype $entity
     * @return type
     * @throws InvalidArgumentException
     */
    public function insert(EntityPrototype $entity)
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        $sqlObject = new Insert($this->table);
        $sqlObject->values($entity->toArray());

        return $this->mapper->insert($sqlObject);
    }

    /**
     *
     * @param EntityPrototype $entity
     * @return type
     * @throws InvalidArgumentException
     */
    public function update(EntityPrototype $entity)
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        if (null == $this->primary_key) {
            throw new InvalidArgumentException('Primary key not set.');
        }

        if (null == $entity->getId()) {
            throw new InvalidArgumentException('Row ID is not set correctly');
        }

        $sqlObject = new Update($this->table);
        $sqlObject->set($entity->toArray());
        $sqlObject->where(["{$this->primary_key} = ?" => $entity->getId()]);

        return $this->mapper->update($sqlObject);
    }

    /**
     *
     * @param EntityPrototype $entity
     * @return type
     * @throws InvalidArgumentException
     */
    public function delete(EntityPrototype $entity)
    {
        if (null == $this->table) {
            throw new InvalidArgumentException('Table schema not set.');
        }

        if (null == $this->primary_key) {
            throw new InvalidArgumentException('Primary key not set.');
        }

        if (null == $entity->getId()) {
            throw new InvalidArgumentException('Row ID is not set correctly');
        }

        $sqlObject = new Delete($this->table);
        $sqlObject->where(["{$this->primary_key} = ?" => $entity->getId()]);

        return $this->mapper->delete($sqlObject);
    }

    public function getResultSet()
    {
        return $this->resultSet;
    }
}

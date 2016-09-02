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

use Zend\Db\Sql\AbstractPreparableSql;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Sql;

final class ZendDatabaseMapper implements DatabaseMapperInterface
{
    /**
     * @var Zend\Db\Sql\Sql
     */
    private $sql;

    /**
     * @param Sql $sql
     */
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }

    /**
     * {@inheritDoc}
     */
    public function select(Select $sqlObject)
    {
        return $this->executeStatement($sqlObject);
    }

    /**
     * {@inheritDoc}
     */
    public function insert(Insert $sqlObject)
    {
        return $this->executeStatement($sqlObject);
    }

    /**
     * {@inheritDoc}
     */
    public function update(Update $sqlObject)
    {
        return $this->executeStatement($sqlObject);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Delete $sqlObject)
    {
        return $this->executeStatement($sqlObject);
    }

    /**
     *
     * @param AbstractPreparableSql $sqlObject
     * @return Zend\Db\Adapter\Driver\Pdo\Result
     */
    private function executeStatement(AbstractPreparableSql $sqlObject)
    {
        $statement = $this->sql->prepareStatementForSqlObject($sqlObject);
        return $statement->execute();
    }
}

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

namespace Student\Factory\Service;

use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Exception\InvalidArgumentException;
use Application\Mapper\ZendDatabaseMapper;
use Zend\Db\ResultSet\HydratingResultSet;
use Interop\Container\ContainerInterface;
use Student\Mapper\StudentDatabaseMapper;
use Student\Service\StudentRestService;
use Student\Entity\StudentEntity;
use Zend\Db\Sql\Sql;

final class StudentRestServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!$container->has('student_db_adapter')) {
            throw new InvalidArgumentException('Missing: Student Database Adpater');
        }

        $adapter = $container->get('student_db_adapter');
        $mapper = new ZendDatabaseMapper(new Sql($adapter));
        $resultSet = new HydratingResultSet(new ReflectionHydrator(), new StudentEntity());

        return new StudentRestService(new StudentDatabaseMapper($mapper, $resultSet));
    }
}

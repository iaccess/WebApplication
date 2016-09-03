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

namespace StudentTest\Command;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit\Framework\TestCase;
use Student\Command\Register;

final class RegisterTest extends TestCase
{
    private $tableGateway;
    private $resultSet;
    private $response;
    private $request;

    public function setUp()
    {
        $this->tableGateway = $this->prophesize(TableGateway::class);
        $this->response     = $this->prophesize(ResponseInterface::class);
        $this->request      = $this->prophesize(ServerRequestInterface::class);
        $this->resultSet    = $this->prophesize(ResultSet::class);
    }

    public function invalidConditions()
    {
        return [
            // NONE POST
            'Get;200'       => ['GET', 200],
            'Put;200'       => ['PUT', 200],
            'Patch;200'     => ['PATH', 200],
            'Delete;200'    => ['DELETE', 200],
            // WITH POST
            'Post;20x'      => ['POST', 201],
            'Post;30x'      => ['POST', 301],
            'Post;40x'      => ['POST', 401],
        ];
    }

    public function testConstructorInjectionShouldReceiveTableGatewayObject()
    {
        $object = new Register($this->tableGateway->reveal());

        $this->assertTrue($object instanceof Register);
    }

    /**
     * @dataProvider invalidConditions
     * @param type $method
     * @param type $code
     */
    public function testInvokeMustReturnNullIfConditionsNotMet($method, $code)
    {
        $this->request->getMethod()->willReturn($method);
        $this->response->getStatusCode()->willReturn($code);

        $object = new Register($this->tableGateway->reveal());
        $output = $object->__invoke(
            $this->request->reveal(),
            $this->response->reveal(),
            function () {
            }
        );

        $this->assertNull($output);
    }

    public function testShouldNotAllowDuplicateData()
    {
        $duplicate = [
            'first_name'    => "GAB",
            'middle_name'   => "A",
            'last_name'     => "AMBA"
        ];

        $this->response->getStatusCode()->willReturn(200);
        $this->response->withStatus(409)->willReturn(null);

        $this->request->getMethod()->willReturn("POST");
        $this->request->getParsedBody()->willReturn($duplicate);

        $this->resultSet->count()->willReturn(1);

        $this->tableGateway->select($duplicate)->willReturn($this->resultSet->reveal());
        $object = new Register($this->tableGateway->reveal());

        $output = $object->__invoke(
            $this->request->reveal(),
            $this->response->reveal(),
            function () {
            }
        );

        $this->assertNull($output);
    }

    public function testInsertNewRecord()
    {
        $duplicate = [
            'first_name'    => "GAB",
            'middle_name'   => "A",
            'last_name'     => "AMBA"
        ];

        $this->response->getStatusCode()->willReturn(200);
        $this->response->withStatus(201)->willReturn(null);

        $this->request->getMethod()->willReturn("POST");
        $this->request->getParsedBody()->willReturn($duplicate);

        $this->resultSet->count()->willReturn(0);

        $this->tableGateway->select($duplicate)->willReturn($this->resultSet->reveal());
        $this->tableGateway->insert($duplicate)->willReturn(1);

        $object = new Register($this->tableGateway->reveal());

        $output = $object->__invoke(
            $this->request->reveal(),
            $this->response->reveal(),
            function () {
            }
        );

        $this->assertNull($output);
    }

    public function testFailToInsertNewRecord()
    {
        $duplicate = [
            'first_name'    => "GAB",
            'middle_name'   => "A",
            'last_name'     => "AMBA"
        ];

        $this->response->getStatusCode()->willReturn(200);
        $this->response->withStatus(500)->willReturn(null);

        $this->request->getMethod()->willReturn("POST");
        $this->request->getParsedBody()->willReturn($duplicate);

        $this->resultSet->count()->willReturn(0);

        $this->tableGateway->select($duplicate)->willReturn($this->resultSet->reveal());
        $this->tableGateway->insert($duplicate)->willReturn(0);

        $object = new Register($this->tableGateway->reveal());

        $output = $object->__invoke(
            $this->request->reveal(),
            $this->response->reveal(),
            function () {
            }
        );

        $this->assertNull($output);
    }
}

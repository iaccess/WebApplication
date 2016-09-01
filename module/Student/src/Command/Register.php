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

namespace Student\Command;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Stratigility\MiddlewareInterface;
use Zend\Db\TableGateway\TableGateway;

final class Register implements MiddlewareInterface
{
    /**
     * @var TableGateway
     */
    private $table;

    public function __construct(TableGateway $table)
    {
        $this->table = $table;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        if ('POST' !== strtoupper($request->getMethod())) {
            return $out($request, $response);
        }

        if ((200 !== $response->getStatusCode())) {
            return $out($request, $response);
        }

        $data = $request->getParsedBody();
        $data['first_name']     = mb_strtoupper($data['first_name'], 'UTF-8');
        $data['middle_name']    = mb_strtoupper($data['middle_name'], 'UTF-8');
        $data['last_name']      = mb_strtoupper($data['last_name'], 'UTF-8');

        unset($data['submit']);

        $select = [
            'first_name'    => $data['first_name'],
            'middle_name'   => $data['middle_name'],
            'last_name'     => $data['last_name'],
        ];

        $output = $this->table->select($select);

        if ($output->count() > 0) {
            return $out($request, $response->withStatus(409));
        }

        if (!$result = $this->table->insert($data)) {
            return $out($request, $response->withStatus(500));
        }

        return $out($request, $response->withStatus(201));
    }
}

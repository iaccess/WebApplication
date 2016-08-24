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

namespace Student\Service;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Application\Service\AbstractRestService;
use Student\Mapper\StudentDatabaseMapper;
use Zend\Diactoros\Response\RedirectResponse;

final class StudentRestService extends AbstractRestService
{
    protected $mapper;

    public function __construct(StudentDatabaseMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(Request $request, Response $response, callable $out = null)
    {
        return $this->createResponse(['students' => $this->mapper->select()->toArray()]);
    }

    /**
     * {@inheritDoc}
     */
    public function get(Request $request, Response $response, callable $out = null)
    {
        $id = $request->getAttribute(self::IDENTIFIER_NAME);
        $result = $this->mapper->select($id);

        // Return error message if data is missing
        if ($result->count() === 0) {
            $code       = 404;
            $status     = 'Not Found';
            $message    = "Sorry, No records found.";

            return $this->createResponse($this->formatMessage($code, $status, $message), $code);
        }

        return $this->createResponse(['student' => $result->toArray()]);
    }

    /**
     * {@inheritDoc}
     */
    public function create(Request $request, Response $response, callable $out = null)
    {
        $data = $request->getParsedBody()['student'];

        try {
            $hydrator   = $this->mapper->getResultSet()->getHydrator();
            $entity     = $this->mapper->getResultSet()->getObjectPrototype();

            // Update the current entity data
            $hydrator->hydrate($data, $entity);

            $output = $this->mapper->insert($entity);

            $code   = 200;
            $status = 'OK';
            $message = sprintf("Successfully added.");
        } catch (\Exception $ex) {
            $code = 403;
            $status = 'Forbidden';
            $message = "Cannot process your request.";
        }

        $this->createResponse($this->formatMessage($code, $status, $message), $code);

        return new RedirectResponse('/student/admission');
    }

    /**
     * {@inheritDoc}
     */
    public function update(Request $request, Response $response, callable $out = null)
    {
        // Initialized request data
        $id = $request->getAttribute(self::IDENTIFIER_NAME);
        $data = $request->getParsedBody();

        $result = $this->mapper->fetchById($id);

        if ($result->count() > 0) {
            $hydrator   = $result->getHydrator();
            $object     = $result->current();

            // Update the current entity data
            $hydrator->hydrate($data, $object);

            $result = $this->mapper->update($object);

            $code   = 200;
            $status = 'OK';
            $message = sprintf("Employee with id '%s' is successfully updated.", $data['emp_id']);
        } else {
            $code   = 404;
            $status = 'Not Found';
            $message = sprintf("Employee with id '%s' is not a valid record.", $data['emp_id']);
        }

        return $this->createResponse($this->formatMessage($code, $status, $message), $code);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param callable $out
     */
    public function delete(Request $request, Response $response, callable $out = null)
    {
        $id = $request->getAttribute(self::IDENTIFIER_NAME);
        $result = $this->mapper->fetchById($id);

        if ($result->count() > 0) {
            $this->mapper->delete($result->current());
            $code   = 200;
            $status = 'OK';
            $message = sprintf("Employee with id '%s' is successfully removed.", $id);
        } else {
            $code   = 404;
            $status = 'Not Found';
            $message = sprintf("Employee with id '%s' is not a valid record.", $id);
        }

        return $this->createResponse($this->formatMessage($code, $status, $message), $code);
    }
}

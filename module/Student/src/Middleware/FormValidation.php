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

namespace Student\Middleware;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Hydrator\Reflection;
use Student\Model\Profile;
use Zend\Form\Form;

final class FormValidation implements MiddlewareInterface
{
    /**
     * @var Form
     */
    private $form;

    public function __construct(Form $form)
    {
        $this->form  = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null)
    {
        if (('POST' !== strtoupper($request->getMethod()))) {
            return $out($request, $response);
        }

        $student  = new Profile();
        $data = $request->getParsedBody();

        $hydrator = new Reflection();
        $hydrator->hydrate($data, $student);

        $this->form->bind($student);

        if (!$this->form->isValid()) {
            return $out(
                $request->withAttribute('form-validation-errors', $this->form->getMessages()),
                $response->withStatus(406)
            );
        }

        return $out($request, $response);
    }
}

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

namespace Student\Page;

use Zend\Expressive\Template\TemplateRendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Zend\Diactoros\Response\RedirectResponse;
use Zend\Stratigility\MiddlewareInterface;
use Zend\Diactoros\Response\HtmlResponse;

final class Admission implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    public function __construct(TemplateRendererInterface $template)
    {
        $this->template = $template;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $data   = $request->getParsedBody();
        $params = [];

        if ('POST' == $request->getMethod()) {
            if (500 == $response->getStatusCode()) {
                $params['error_message'] = "Name already existing";
                $params['currentData'] = $data;
            }

            if (409 == $response->getStatusCode()) {
                $params['error_message'] = "Name already existing";
                $params['currentData'] = $data;
                $params['validationErrors'] = [
                    'first_name' => 'Name already existing',
                    'middle_name' => 'Name already existing',
                    'last_name' => 'Name already existing',
                ];
            }

            if (406 == $response->getStatusCode()) {
                $params['currentData'] = $data;
                $params['validationErrors'] = $request->getAttribute('form-validation-errors');
            }

            if (201 == $response->getStatusCode()) {
                $params['message'] = "Successfully added.";
                //return new RedirectResponse('/enrollment');
            }
        }

        return new HtmlResponse($this->template->render('student::admission', $params));
    }
}

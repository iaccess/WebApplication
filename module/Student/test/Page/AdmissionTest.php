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

namespace StudentTest\Page;

use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response;
use Student\Page\Admission;
use Faker\Factory;

final class AdmissionTest extends TestCase
{
    /** @var TemplateRendererInterface */
    private $template;

    /**
     * Html Content
     * @var string
     */
    private $page;

    private $params = [];

    public function setUp()
    {
        $this->template = $this->prophesize(TemplateRendererInterface::class);
    }

    public function testMustReturnHtmlResponse()
    {
        $data = [];
        $this->template->render('student::admission', $data)->willReturn('html page');
        $page = new Admission($this->template->reveal());
        $this->assertTrue($page instanceof Admission);

        $response = $page(new ServerRequest(['/']), new Response());

        $this->assertTrue($response instanceof HtmlResponse);
    }

    public function testPostExistingRecordWith500Status()
    {
        $person = Factory::create();
        $stub = [
            'first_name'    => $person->firstName,
            'middle_name'   => $person->lastName,
            'last_name'     => $person->lastName
        ];


        $request  = $this->prophesize(ServerRequest::class);
        $request->getMethod()->willReturn("POST");
        $request->getParsedBody()->willReturn($stub);

        $response = $this->prophesize(Response::class);
        $response->getStatusCode()->willReturn(500);

        $this->params['currentData'] = $stub;
        $this->params['error_message'] = "Name already existing";

        $this->template->render('student::admission', $this->params)->willReturn('html page');

        $page = new Admission($this->template->reveal());
        $response = $page($request->reveal(), $response->reveal());

        $this->assertTrue($response instanceof HtmlResponse);
    }

    public function testPostExistingRecordWith409Status()
    {
        $person = Factory::create();
        $stub = [
            'first_name'    => $person->firstName,
            'middle_name'   => $person->lastName,
            'last_name'     => $person->lastName
        ];


        $request  = $this->prophesize(ServerRequest::class);
        $request->getMethod()->willReturn("POST");
        $request->getParsedBody()->willReturn($stub);

        $response = $this->prophesize(Response::class);
        $response->getStatusCode()->willReturn(409);

        $this->params['currentData'] = $stub;
        $this->params['error_message'] = "Name already existing";
        $this->params['validationErrors'] = [
           'first_name'    => 'Name already existing',
           'middle_name'   => 'Name already existing',
           'last_name'     => 'Name already existing',
        ];

        $this->template->render('student::admission', $this->params)->willReturn('html page');

        $page = new Admission($this->template->reveal());
        $response = $page($request->reveal(), $response->reveal());

        $this->assertTrue($response instanceof HtmlResponse);
    }

    public function testPostWithValidationErrors()
    {
        $person = Factory::create();
        $stub = [
            'first_name'    => $person->firstName,
            'middle_name'   => $person->lastName,
            'last_name'     => $person->lastName
        ];

        $errors = [
            'first_name'    => 'Name already existing',
            'middle_name'   => 'Name already existing',
            'last_name'     => 'Name already existing',
        ];

        $request  = $this->prophesize(ServerRequest::class);
        $request->getMethod()->willReturn("POST");
        $request->getParsedBody()->willReturn($stub);
        $request->getAttribute('form-validation-errors')->willReturn($errors);

        $response = $this->prophesize(Response::class);
        $response->getStatusCode()->willReturn(406);

        $this->params['currentData'] = $stub;
        $this->params['validationErrors'] = $errors;
        $this->template->render('student::admission', $this->params)->willReturn('html page');

        $page = new Admission($this->template->reveal());
        $response = $page($request->reveal(), $response->reveal());

        $this->assertTrue($response instanceof HtmlResponse);
    }

    public function testPostWithSuccessfullyCreatedRecord()
    {
        $person = Factory::create();
        $stub = [
            'first_name'    => $person->firstName,
            'middle_name'   => $person->lastName,
            'last_name'     => $person->lastName
        ];

        $request  = $this->prophesize(ServerRequest::class);
        $request->getMethod()->willReturn("POST");
        $request->getParsedBody()->willReturn($stub);

        $response = $this->prophesize(Response::class);
        $response->getStatusCode()->willReturn(201);

        $this->params['message'] = "Successfully added.";
        $this->template->render('student::admission', $this->params)->willReturn('html page');

        $page = new Admission($this->template->reveal());
        $response = $page($request->reveal(), $response->reveal());

        $this->assertTrue($response instanceof HtmlResponse);
    }
}

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

namespace SiteTest\Page\Home;

use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Site\Page\Home\HomePageAction;
use Zend\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response;


final class HomePageActionTest extends TestCase
{
    /** @var TemplateRendererInterface */
    protected $template;

    /**
     * Html Content
     * @var string
     */
    protected $page;

    protected function setUp()
    {
        $this->template = $this->prophesize(TemplateRendererInterface::class);
        $this->template->render('site::home')->willReturn('html page');
    }

    public function testMustReturnHtmlResponse()
    {
        $homePage = new HomePageAction($this->template->reveal());
        $this->assertTrue($homePage instanceof HomePageAction);
        
        $response = $homePage(new ServerRequest(['/']), new Response(), function () {});
        $this->assertTrue($response instanceof HtmlResponse);
    }
}

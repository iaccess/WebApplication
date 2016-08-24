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

namespace ApplicationTest\Factory\Page;

use Application\Factory\Page\HtmlPageInitializerFactory;
use Zend\Expressive\Template\TemplateRendererInterface;
use Site\Page\Home\HomePageAction;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;

final class HtmlPageInitializerFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);        
    }
    
    public function testHtmlPageInitializerTemplateFactory()
    {
        $factory = new HtmlPageInitializerFactory();
        $this->assertTrue($factory instanceof HtmlPageInitializerFactory);
        
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);                                                             
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));
        
        $homePage = $factory($this->container->reveal(), HomePageAction::class);
        
        $this->assertTrue($homePage instanceof HomePageAction);
    }
    
    public function testFactoryWithoutTemplate()
    {
        $factory = new HtmlPageInitializerFactory();
        $this->assertTrue($factory instanceof HtmlPageInitializerFactory);
        
        $this->container->has(TemplateRendererInterface::class)->willReturn(false); 
        
        $homePage = $factory($this->container->reveal(), HomePageAction::class);
        
        $this->assertFalse($homePage instanceof HomePageAction);
    }
}
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

namespace StudentTest;

use PHPUnit\Framework\TestCase;
use Student;

final class ConfigProviderTest extends TestCase
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function setUp()
    {
        $this->configProvider = new Student\ConfigProvider();
    }

    public function testConfigProviderKeySettings()
    {
        $config = $this->configProvider->__invoke();
        $this->assertArrayHasKey('templates', $config);
        $this->assertArrayHasKey('routes', $config);
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('view_helpers', $config);
        $this->assertArrayHasKey('middleware_pipeline', $config);
    }

    public function testViewConfigKeySettings()
    {
        $config = $this->configProvider->getViewConfig();
        $this->assertArrayHasKey('paths', $config);
    }

    public function testRouteConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getRouteConfig(),
            //Array of expected data
            [
                'home'   => [
                    'name'              => 'home',
                    'path'              => '/',
                    'allowed_methods'   => ['GET'],
                    'middleware'        => Student\Page\Admission::class
                ],
                'student.admission'   => [
                    'name'              => 'student.admission',
                    'path'              => '/admission',
                    'allowed_methods'   => ['GET', 'POST'],
                    'middleware'        => [
                        Student\Middleware\FormValidation::class,
                        Student\Command\Register::class,
                        Student\Page\Admission::class
                    ]
                ],
                'student.masterlist'   => [
                    'name'              => 'student.masterlist',
                    'path'              => '/students',
                    'allowed_methods'   => ['GET'],
                    'middleware'        => [
                        Student\Query\Masterlist::class,
                        Student\Page\Masterlist::class
                    ]
                ],
                'student.transcript'   => [
                    'name'              => 'student.transcript',
                    'path'              => '/students/:id',
                    'allowed_methods'   => ['GET'],
                    'middleware'        => [
                        Student\Query\Prime::class,
                        Student\Page\Profile::class
                    ]
                ]
            ]
        );
    }

    public function testServiceConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getServiceConfig(),
            //Array of expected data
            [
                'invokables'    => [
                    Student\Form\EnlistmentForm::class          => Student\Form\EnlistmentForm::class
                ],
                'factories'     => [
                    Student\Page\Admission::class               => Student\Factory\HtmlPageFactory::class,
                    Student\Page\Profile::class                 => Student\Factory\HtmlPageFactory::class,
                    Student\Page\Masterlist::class              => Student\Factory\HtmlPageFactory::class,
                    Student\Middleware\FormValidation::class    => Student\Factory\FormValidationFactory::class,
                    Student\Command\Register::class             => Student\Factory\CommandFactory::class,
                    Student\Query\Prime::class                  => Student\Factory\QueryFactory::class,
                    Student\Query\Masterlist::class             => Student\Factory\QueryFactory::class,
                ],
            ]
        );
    }

    public function testMiddlewareConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getMiddlewareConfig(),
            //Array of expected data
            [
            //                'api'   => [
            //                    'path'          => '/api',
            //                    'priority'      => 1000,
            //                    'middleware'    => [
            //                        //Middleware\AuthenticationMiddleware::class,
            //                        //BodyParamsMiddleware::class
            //                    ]
            //                ],
            //                'student.api'   => [
            //                    'path'          => '/api/students',
            //                    'priority'      => 900,
            //                    'middleware'    => [
            //                        Student\Middleware\FormValidation::class,
            //                    ],
            //                ]
            ]
        );
    }

    public function testViewHelperConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getViewHelperConfig(),
            //Array of expected data
            [
                'invokables'   => [
                    'studentForm' => Student\Form\EnlistmentForm::class
                ]
            ]
        );
    }
}

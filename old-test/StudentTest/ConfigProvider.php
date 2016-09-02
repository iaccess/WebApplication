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
use Application\Factory as AppFactory;
use Student;

final class ConfigProviderTest extends TestCase
{
    private $configProvider;

    public function setUp()
    {
        $this->configProvider = new Student\ConfigProvider();
    }

    public function testApplicationConfigProviderKeySettings()
    {
        $config = $this->configProvider->__invoke();
        
        $this->assertArrayHasKey('routes', $config);
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('templates', $config);
        $this->assertArrayHasKey('view_helpers', $config);
    }

    public function testServiceConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getServiceConfig(),
            //Array of expected data
            [
                'factories' => [
                    Student\Page\AdmissionPageAction::class     => AppFactory\Page\HtmlPageInitializerFactory::class,
                    Student\Service\StudentRestService::class   => Student\Factory\Service\StudentRestServiceFactory::class
                ]
            ]
        );
    }

    public function testRouteConfigKeySettings()
    {
        $this->assertArraySubset(
            $this->configProvider->getRouteConfig(),
            //Array of expected data
            [
                [
                    "name"              => "student-admission",
                    "allowed_methods"   => ['GET'],
                    "path"              => "/student/admission",
                    "middleware"        => [
                        Student\Page\AdmissionPageAction::class
                    ]
                ],
                [
                    "name"              => "api.students",
                    "allowed_methods"   => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'],
                    "path"              => "/api/students[/:id]",
                    "middleware"        => [
                        Student\Service\StudentRestService::class
                    ]
                ]
            ]
        );
    }
}

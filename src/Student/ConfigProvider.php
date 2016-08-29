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

namespace Student;

use Application\Factory as AppFactory;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies'  => $this->getServiceConfig(),
            'routes'        => $this->getRouteConfig(),
            'templates'     => $this->getViewConfig(),
            'view_helpers'  => $this->getViewHelperConfig()
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Page\AdmissionPageAction::class     => AppFactory\PageFactory::class,
                Service\StudentRestService::class   => Factory\Service\StudentRestServiceFactory::class
            ]
        ];
    }

    public function getRouteConfig()
    {
        return [
//            'student-admission' => [
//                "name"              => "student-admission",
//                "allowed_methods"   => ['GET'],
//                "path"              => "/student/admission",
//                "middleware"        => [
//                    Page\AdmissionPageAction::class
//                ]
//            ],
            [
                "name"              => "api.students",
                "allowed_methods"   => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'],
                "path"              => "/api/students[/:id]",
                "middleware"        => [
                    Service\StudentRestService::class
                ]
            ]
        ];
    }

    public function getViewConfig()
    {
        return [
            "paths"  => [
                //'student'   => [__DIR__ . "/../../templates/student"]
            ]
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables'    => [
                'studentForm'   => Form\Form137::class,
            ],
            'factories'     => [
                'students'  => Factory\StudentRepositoryFactory::class,
            ]
        ];
    }
}

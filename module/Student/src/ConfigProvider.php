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

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies'          => $this->getServiceConfig(),
            'routes'                => $this->getRouteConfig(),
            'templates'             => $this->getViewConfig(),
            'view_helpers'          => $this->getViewHelperConfig(),
            'middleware_pipeline'   => $this->getMiddlewareConfig()
        ];
    }

    public function getServiceConfig()
    {
        return [
            'invokables'    => [
                Form\EnlistmentForm::class          => Form\EnlistmentForm::class
            ],
            'factories'     => [
                Page\Admission::class               => Factory\HtmlPageFactory::class,
                Page\Profile::class                 => Factory\HtmlPageFactory::class,
                Page\Masterlist::class              => Factory\HtmlPageFactory::class,
                Middleware\FormValidation::class    => Factory\FormValidationFactory::class,
                Command\Register::class             => Factory\CommandFactory::class,
                Query\Prime::class                  => Factory\QueryFactory::class,
                Query\Masterlist::class             => Factory\QueryFactory::class,
            ],
        ];
    }

    public function getRouteConfig()
    {
        return [
            'home'   => [
                'name'              => 'home',
                'path'              => '/',
                'allowed_methods'   => ['GET'],
                'middleware'        => Page\Admission::class
            ],
            'student.admission'   => [
                'name'              => 'student.admission',
                'path'              => '/admission',
                'allowed_methods'   => ['GET', 'POST'],
                'middleware'        => [
                    Middleware\FormValidation::class,
                    Command\Register::class,
                    Page\Admission::class
                ]
            ],
            'student.masterlist'   => [
                'name'              => 'student.masterlist',
                'path'              => '/students',
                'allowed_methods'   => ['GET'],
                'middleware'        => [
                    Query\Masterlist::class,
                    Page\Masterlist::class
                ]
            ],
            'student.transcript'   => [
                'name'              => 'student.transcript',
                'path'              => '/students/:id',
                'allowed_methods'   => ['GET'],
                'middleware'        => [
                    Query\Prime::class,
                    Page\Profile::class
                ]
            ]
        ];
    }

    public function getMiddlewareConfig()
    {
        return [
//            'api'   => [
//                'path'          => '/api',
//                'priority'      => 1000,
//                'middleware'    => [
//                    //Middleware\AuthenticationMiddleware::class,
//                    //BodyParamsMiddleware::class
//                ]
//            ],
//            'student.api' => [
//                'path'          => '/api/students',
//                'priority'      => 900,
//                'middleware'    => [
//                    Middleware\FormValidation::class,
//                ],
//            ],
//            'error' => [
//                'priority'      => -1000,
//                'middleware'    => [
//                    Page\RedirectPage::class
//                ]
//            ]
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables'    => [
                'studentForm'   => Form\EnlistmentForm::class
            ]
        ];
    }

    public function getViewConfig()
    {
        return [
            'paths'     => [
                'student'     => [__DIR__ . '/../templates/student'],
            ]
        ];
    }
}

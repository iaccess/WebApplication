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

namespace Application;

use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies'          => $this->getServiceConfig(),
            'routes'                => $this->getRouteConfig(),
            'templates'             => $this->getViewConfig(),
            'middleware_pipeline'   => $this->getMiddlewareConfig()
        ];
    }

    public function getServiceConfig()
    {
        return [
            'invokables'    => [
                Middleware\AuthenticationMiddleware::class => Middleware\AuthenticationMiddleware::class,
            ],
            'factories'     => [
                Page\Admission::class               =>  Factory\PageFactory::class,
                Page\Attendance::class              =>  Factory\PageFactory::class,
                Page\Billing::class                 =>  Factory\PageFactory::class,
                Page\ClassSchedule::class           =>  Factory\PageFactory::class,
                Page\CourseOffering::class          =>  Factory\PageFactory::class,
                Page\Enrollment::class              =>  Factory\PageFactory::class,
                Page\Grade::class                   =>  Factory\PageFactory::class,
                Page\Home::class                    =>  Factory\PageFactory::class,
                Page\Exam::class                    =>  Factory\PageFactory::class,
                Page\Passbook::class                =>  Factory\PageFactory::class,
                Page\Student::class                 =>  Factory\PageFactory::class,
                Page\PermanentRecord::class         =>  Factory\PageFactory::class,
                Page\Transcript::class              =>  Factory\PageFactory::class,
                Page\Tesda::class                   =>  Factory\PageFactory::class,

                Service\EnrollmentService::class    => Factory\EnrollmentServiceFactory::class
            ]
        ];
    }

    public function getRouteConfig()
    {
        return [
            [
                "name"              => "home",
                "path"              => "/",
                "allowed_methods"   => ['GET'],
                "middleware"        => Page\Admission::class,
            ],

            // Staff Account links
            [
                "name"              => "student-admission",
                "path"              => "/admission",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Admission::class
            ],
            [
                "name"              => "enrollment",
                "path"              => "/enrollment",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Enrollment::class
            ],

            // Registrar
            [
                "name"              => "student-list",
                "path"              => "/students",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Student::class,
            ],
            [
                "name"              => "student-record",
                "path"              => "/records/:id",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\PermanentRecord::class,
            ],
            [
                "name"              => "course-offering",
                "path"              => "/courses/offering",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\CourseOffering::class
            ],
            [
                "name"              => "class-scheduling",
                "path"              => "/classes",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\CourseOffering::class
            ],
            [
                "name"              => "transcript",
                "path"              => "/transcripts",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Transcript::class,
            ],
            [
                "name"              => "tesda-report",
                "path"              => "/tesda-report",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Tesda::class,
            ],
//
//            [
//                "name"              => "students",
//                "path"              => "/students",
//                "allowed_methods"   => ['GET'],
//                'middleware'        => Students::class
//            ],
//            [
//                "name"              => "students-grades",
//                "path"              => "/students/grades",
//                "allowed_methods"   => ['GET'],
//                'middleware'        => Students\Grades::class
//            ],

            // Accounting
            [
                "name"              => "student-billing-account",
                "path"              => "/students/payment-transactions",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Billing::class
            ],
            [
                "name"              => "enrollment-billing",
                "path"              => "/enrollment/billing",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Billing::class
            ],

            // student account links
            'student-profile' => [
                "name"              => "student-profile",
                "path"              => "/account",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Home::class
            ],
            [
                "name"              => "student-enrollment",
                "path"              => "/enroll",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Enrollment::class
            ],
            [
                "name"              => "student-classes",
                "path"              => "/schedules",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\ClassSchedule::class
            ],
            [
                "name"              => "student-grades",
                "path"              => "/grades",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Grade::class
            ],
            [
                "name"              => "student-passbook",
                "path"              => "/passbook",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Passbook::class
            ],

            // employee account links
            'employee-profile' => [
                "name"              => "employee-profile",
                "path"              => "/profile",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Profile::class
            ],

            // Faculty Account links
            [
                "name"              => "teaching-load",
                "path"              => "/class/schedules",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\ClassSchedule::class
            ],
            [
                "name"              => "class-exams",
                "path"              => "/class/exams",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Exam::class
            ],
            [
                "name"              => "class-attendance",
                "path"              => "/class/attendance",
                "allowed_methods"   => ['GET'],
                'middleware'        => Page\Attendance::class
            ],


            [
                "name"              => "enrollment.api",
                "path"              => "/api/enrollment",
                "allowed_methods"   => ['POST'],
                'middleware'        => Service\EnrollmentService::class
            ],
        ];
    }

    public function getMiddlewareConfig()
    {
        return [
            'api'   => [
                'path'          => '/api',
                'priority'      => 1000,
                'middleware'    => [
                    Middleware\AuthenticationMiddleware::class,
                    BodyParamsMiddleware::class
                ]
            ]
        ];
    }

    public function getViewConfig()
    {
        $path = __DIR__ . '/../../templates';

        return [
            'layout'    => 'layout/dashboard',
            'map'       => [
                //Site related settings
                'layout/layout'                     => $path . "/layout/default.phtml",
                'partial/header'                    => $path . '/layout/partial/header.phtml',
                'partial/footer'                    => $path . '/layout/partial/footer.phtml',
                'widget/banner/footer'              => $path . '/layout/widget/banner/footer.phtml',
                'template/navigation'               => $path . '/layout/template/navigation.phtml',
                'template/breadcrumbs'              => $path . '/layout/template/breadcrumbs.phtml',

                //Dashboard related settings
                'layout/dashboard'                  => $path . '/layout/dashboard.phtml',
                'template/navigation/sidebar'       => $path . '/layout/template/navigation/sidebar.phtml',
                'template/navigation/header'        => $path . '/layout/template/navigation/header.phtml',
                'template/navigation/breadcrumbs'   => $path . '/layout/template/navigation/breadcrumbs.phtml',
                'partial/navigation/header'         => $path . '/layout/partial/navigation/header.phtml',
                'partial/navigation/sidebar'        => $path . '/layout/partial/navigation/sidebar.phtml',
                'partial/navigation/breadcrumbs'    => $path . '/layout/partial/navigation/breadcrumbs.phtml',
                'partial/footer'                    => $path . '/layout/partial/footer.phtml',
                'boxcar/small'                      => $path . '/layout/widget/boxcar/small.phtml'
            ],
            'paths'     => [
                'error'     => [$path . '/error'],
                'layout'    => [$path . '/layout'],
                'dashboard' => [$path . '/dashboard'],
                'student'   => [$path . '/student'],
            ]
        ];
    }
}

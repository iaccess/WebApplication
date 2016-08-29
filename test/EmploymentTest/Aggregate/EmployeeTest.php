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

namespace CqrsTest\Aggregate;

use PHPUnit\Framework\TestCase;
use Cqrs\ValueObject\Duration;
use Zend\Hydrator\Reflection;
use Cqrs\Aggregate\Employee;
use Cqrs\Entity\Personnel;
use Cqrs\Entity\Position;

final class EmployeeTest extends TestCase
{
    /**
     * @dataProvider applicants
     */
    public function testHireNewEmployee($resume, $job_post)
    {
        $hydrator   = new Reflection();
        $personnel  = new Personnel();
        $position   = new Position();

        $hydrator->hydrate($resume, $personnel);
        $hydrator->hydrate($job_post, $position);

        $result = Employee::hire($personnel, $position);

        $this->assertEquals("Welcome {$personnel->firstName()}, our new {$position->title()}", $result);
    }

    /**
     * @dataProvider applicants
     */
    public function testEmployeePromotion($employee, $new_post)
    {
        $hydrator   = new Reflection();
        $personnel  = new Personnel();
        $position   = new Position();

        $hydrator->hydrate($employee, $personnel);
        $hydrator->hydrate($new_post, $position);

        $result = Employee::promote($personnel, $position);

        $this->assertEquals(
            "Contratulations {$personnel->firstName()}! You're promoted as our new {$position->title()}",
            $result
        );
    }

    public function applicants()
    {
        return [
            [
                [
                    'first_name'    => 'Gabby',
                    'middle_name'   => 'D',
                    'last_name'     => 'Gab'
                ],
                [
                    'title' => 'Chief Architect',
                    'description'   => "You're Awesome."
                ]
            ],
            [
                [
                    'first_name'    => 'Gab',
                    'middle_name'   => 'A',
                    'last_name'     => 'Amba'
                ],
                [
                    'title' => 'CEO',
                    'description'   => "You're Awesome."
                ]
            ],
        ];
    }
}

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

namespace CqrsTest\Entity;

use Zend\Hydrator\Reflection;
use PHPUnit\Framework\TestCase;
use Cqrs\Entity\Position;

final class PositionTest extends TestCase
{
    public function testObjectToPopulateUsingReflection()
    {
        $hydrator = new Reflection();
        $position = new Position();

        $data = [
            'title' => 'Chief Architect',
            'description'   => "You're Awesome."
        ];

        $hydrator->hydrate($data, $position);

        $this->assertEquals($data['title'], $position->title());
        $this->assertEquals($data['description'], $position->description());
    }

    public function testDefaultResponsibilitiesMustBeEmpty()
    {
        $position = new Position();
        $this->assertEmpty($position->responsibilities());
    }

    public function testAddingOfResponsibilities()
    {
        $position = new Position();
        $position->addResponsibility('responsibility#1');

        $this->assertEquals(['responsibility#1'], $position->responsibilities());
    }

    public function testRemovingOfResponsibilities()
    {
        $position = new Position();

        $position->addResponsibility('responsibility#1');
        $position->addResponsibility('responsibility#2');

        $this->assertEquals(['responsibility#1', 'responsibility#2'], $position->responsibilities());

        $position->removeResponsibility('responsibility#1');

        // Array Key Validation is not yet tested.
        $this->assertEquals(['responsibility#2'], array_values($position->responsibilities()));
    }
}

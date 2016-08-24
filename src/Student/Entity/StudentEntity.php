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

namespace Student\Entity;

use Application\Entity\EntityPrototype;

final class StudentEntity implements EntityPrototype
{
    private $guid;
    private $student_id;
    private $first_name;
    private $middle_name;
    private $last_name;

    public function getStudentId()
    {
        return $this->student_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getMiddleName()
    {
        return $this->middle_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getId()
    {
        return $this->guid;
    }

    public function toArray()
    {
        return [
            'first_name'    => $this->getFirstName(),
            'middle_name'   => $this->getMiddleName(),
            'last_name'     => $this->getLastName(),
        ];
    }

    public function getInfo()
    {
        return [
            'student_id'    => $this->getStudentId(),
            'first_name'    => $this->getFirstName(),
            'middle_name'   => $this->getMiddleName(),
            'last_name'     => $this->getLastName(),
        ];
    }
}

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
use Zend\Form\Annotation;

/**
 * @Annotation\Name("student")
 * @Annotation\Hydrator("Zend\Hydrator\Reflection")
 */
final class StudentEntity implements EntityPrototype
{
    /**
     * @Annotation\Exclude()
     */
    private $guid;

    /**
     * @Annotation\Exclude()
     */
    private $student_id;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"First Name"})
     * @Annotation\Options({"label":"First Name:"})
     */
    private $first_name;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"Middle Name"})
     * @Annotation\Options({"label":"Middle Name:"})
     */
    private $middle_name;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"Last Name"})
     * @Annotation\Options({"label":"Last Name:"})
     */
    private $last_name;

    public function studentId()
    {
        return $this->student_id;
    }

    public function firstName()
    {
        return $this->first_name;
    }

    public function middleName()
    {
        return $this->middle_name;
    }

    public function lastName()
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
            'first_name'    => $this->firstName(),
            'middle_name'   => $this->middleName(),
            'last_name'     => $this->lastName(),
        ];
    }

    public function getInfo()
    {
        return [
            'student_id'    => $this->studentId(),
            'first_name'    => $this->firstName(),
            'middle_name'   => $this->middleName(),
            'last_name'     => $this->lastName(),
        ];
    }
}

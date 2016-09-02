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

namespace Student\Model;

use Zend\Form\Annotation;

/**
 * @Annotation\Name("student")
 * @Annotation\Hydrator("Zend\Hydrator\Reflection")
 */
final class Profile
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
     * @Annotation\Validator({"name":"StringLength", "options":{"min":2, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z_ ]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"First Name"})
     * @Annotation\Options({"label":"First Name:"})
     */
    private $first_name;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":2, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z_ ]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"Middle Name"})
     * @Annotation\Options({"label":"Middle Name:"})
     */
    private $middle_name;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":2, "max":25}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z_ ]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text","class":"form-control", "placeholder":"Last Name"})
     * @Annotation\Options({"label":"Last Name:"})
     */
    private $last_name;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"Date"})
     * @Annotation\Attributes({"type":"date", "id":"birthdate", "class":"form-control"})
     * @Annotation\Options({"label":"Date of Birth:"})
     */
    private $birthdate;

    /**
     * @Annotation\Filter({"name":"Digits"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":11, "max":11}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^(09)\d{9}$/"}})
     * @Annotation\Attributes({"type":"text", "class":"form-control", "placeholder":"Cellphone Number"})
     * @Annotation\Options({"label":"Cellphone Number:"})
     */
    private $contact_number;

    /**
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":4, "max":6}})
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({"label":"Gender:"})
     * @Annotation\Attributes({"class":"form-control", "options":{"male":"Male","female":"Female"}})
     */
    private $gender;

    /**
     * @Annotation\Filter({"name":"Digits"})
     * @Annotation\Validator({"name":"Digits"})
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({"label":"Civil Status:"})
     * @Annotation\Attributes({"class":"form-control", "options":{"1":"Single","2":"Married","3":"Widow/er","4":"Separated"}})
     */
    private $civil_status_id;

    public function getSecureToken()
    {
        return $this->guid;
    }

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

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getContactNumber()
    {
        return $this->contact_number;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCivilStatus()
    {
        return $this->civil_status_id;
    }
}

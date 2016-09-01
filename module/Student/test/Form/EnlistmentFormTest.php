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

namespace StudentTest\Form;

use Student\Form\EnlistmentForm;
use PHPUnit\Framework\TestCase;
use Zend\Hydrator\Reflection;
use Zend\Form\Element\Csrf;
use Student\Model\Profile;

final class EnlistmentFormTest extends TestCase
{
    public function testFormInvocation()
    {
        $form = new EnlistmentForm();

        $this->assertTrue($form->__invoke() instanceof \Zend\Form\Form);
    }

    public function testFormBindingValidation()
    {
        $form       = (new EnlistmentForm())->__invoke();
        $hydrator   = new Reflection();
        $student    = new Profile();
        $csrf       = new Csrf('admission_form_token');
        $data = [
            'student_id'            => '3015-01729',
            'first_name'            => 'Gab',
            'middle_name'           => 'Dy',
            'last_name'             => 'Gab',
            'birthdate'             => '2011-02-18',
            'contact_number'        => '09876543210',
            'admission_form_token'  => $csrf->getValue()
        ];

        $hydrator->hydrate($data, $student);
        $form->bind($student);

        $this->assertTrue($form->isValid(), json_encode($form->getMessages()));
    }
}

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

namespace Student\Form;

use Zend\Form\Annotation\AnnotationBuilder;
use Student\Entity\StudentEntity;
use Zend\Form\Element\Csrf;

final class Form137
{
    /**
     * @todo Need to register the session token $csrf
     */
    public function __invoke()
    {
        $builder = new AnnotationBuilder();
        $form    = $builder->createForm(StudentEntity::class);
        $form->setAttribute('action', '/api/students');

        $form->add(['type' => Csrf::class, 'name' => 'student_record_token']);
        $form->add([
            'name'          => 'submit',
            'attributes'    => [
                'type' => 'submit',
                'value' => 'Add',
                'class' => "btn btn-success pull-right"
            ]
        ]);

        return $form;
    }
}

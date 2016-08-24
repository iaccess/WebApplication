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

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'templates' => $this->getViewConfig()
        ];
    }

    public function getViewConfig()
    {
        $path = __DIR__ . '/../../templates';

        return [
            'map'   => [
                //Site related settings
                'layout/layout'             => $path . "/layout/default.phtml",
                'partial/header'            => $path . '/layout/partial/header.phtml',
                'partial/footer'            => $path . '/layout/partial/footer.phtml',
                'widget/banner/footer'      => $path . '/layout/widget/banner/footer.phtml',
                'template/navigation'       => $path . '/layout/template/navigation.phtml',
                'template/breadcrumbs'      => $path . '/layout/template/breadcrumbs.phtml',

                //Dashboard related settings
                'layout/dashboard'          => $path . '/layout/dashboard.phtml',
                'template/navigation/sidebar'       => $path . '/layout/template/navigation/sidebar.phtml',
                'template/navigation/header'        => $path . '/layout/template/navigation/header.phtml',
                'template/navigation/breadcrumbs'   => $path . '/layout/template/navigation/breadcrumbs.phtml',
                'partial/navigation/header'         => $path . '/layout/partial/navigation/header.phtml',
                'partial/navigation/sidebar'        => $path . '/layout/partial/navigation/sidebar.phtml',
                'partial/navigation/breadcrumbs'    => $path . '/layout/partial/navigation/breadcrumbs.phtml',
                'partial/footer'                    => $path . '/layout/partial/footer.phtml',
                'boxcar/small'                      => $path . '/layout/widget/boxcar/small.phtml'
            ],
            'paths' => [
                'error'     => [$path . '/error'],
                'layout'    => [$path . '/layout']
            ]
        ];
    }
}

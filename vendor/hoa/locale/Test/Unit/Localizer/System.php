<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2017, Hoa community. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace Hoa\Locale\Test\Unit\Localizer;

use Hoa\Locale\Localizer\System as CUT;
use Hoa\Test;

/**
 * Class \Hoa\Locale\Test\Unit\Localizer\System.
 *
 * Test suite of the system localizer.
 *
 * @copyright  Copyright © 2007-2017 Hoa community
 * @license    New BSD License
 */
class System extends Test\Unit\Suite
{
    public function case_classic()
    {
        $this
            ->given(
                $this->function->setlocale = 'C/fr_FR.UTF-8/C/C/C/C',
                $localizer                 = new CUT()
            )
            ->when($result = $localizer->getLocale())
            ->then
                ->string($result)
                    ->isEqualTo('fr-FR');
    }

    public function case_null()
    {
        $this
            ->given(
                $this->function->setlocale = 'C/C/C/C/C/C',
                $localizer                 = new CUT()
            )
            ->when($result = $localizer->getLocale())
            ->then
                ->variable($result)
                    ->isNull();
    }

    public function case_not_encoding()
    {
        $this
            ->given(
                $this->function->setlocale = 'C/fr_FR/C/C/C/C',
                $localizer                 = new CUT()
            )
            ->when($result = $localizer->getLocale())
            ->then
                ->string($result)
                    ->isEqualTo('fr-FR');
    }
}

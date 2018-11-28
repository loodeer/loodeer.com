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

use Hoa\Locale\Localizer\Http as CUT;
use Hoa\Test;

/**
 * Class \Hoa\Locale\Test\Unit\Localizer\Http.
 *
 * Test suite of the HTTP localizer.
 *
 * @copyright  Copyright © 2007-2017 Hoa community
 * @license    New BSD License
 */
class Http extends Test\Unit\Suite
{
    public function case_classic()
    {
        $this
            ->given($localizer = new CUT('fr-fr,en-uk;q=0.7,en;q=0.3'))
            ->when($result = $localizer->getLocale())
            ->then
                ->string($result)
                    ->isEqualTo('fr-fr');
    }

    public function case_cfws()
    {
        $this
            ->given($localizer = new CUT('fr-fr  , en-uk ; q = 0.7'))
            ->when($result = $localizer->getLocale())
            ->then
                ->string($result)
                    ->isEqualTo('fr-fr');
    }

    public function case_q_on_first()
    {
        $this
            ->given($localizer = new CUT('fr-fr;q=0.9,en-uk;q=0.7'))
            ->when($result = $localizer->getLocale())
            ->then
                ->string($result)
                    ->isEqualTo('fr-fr');
    }
}

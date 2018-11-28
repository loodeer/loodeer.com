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

namespace Hoa\Devtools\Resource\PHPCSFixer\Fixer;

use PhpCsFixer\AbstractLinesBeforeNamespaceFixer;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

/**
 * Class \Hoa\Devtools\Resource\PHPCSFixer\Fixer\NoBlankLinesBeforeEntity.
 *
 * Remove blank lines before entity declarations (class, interface, trait etc.).
 *
 * @copyright  Copyright © 2007-2017 Hoa community
 * @license    New BSD License
 */
class NoBlankLinesBeforeEntity extends AbstractLinesBeforeNamespaceFixer
{
    protected function applyfix(SplFileInfo $file, Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if ($token->isGivenKind(T_CLASS) ||
                $token->isGivenKind(T_INTERFACE) ||
                $token->isGivenKind(T_TRAIT)) {
                $docCommentIndex = $tokens->getTokenOfKindSibling(
                    $index,
                    -1,
                    [[T_DOC_COMMENT]],
                    false
                );
                $firstSignificantIndex = $tokens->getNextNonWhitespace($docCommentIndex);
                $this->fixLinesBeforeNamespace($tokens, $firstSignificantIndex, 1);
            }
        }

        return $tokens->generateCode();
    }

    public function getDefinition()
    {
        return new FixerDefinition(
            'Remove blank lines before entity declarations.'
        );
    }

    public function isCandidate(Tokens $tokens)
    {
        return
            $tokens->isTokenKindFound(T_CLASS) ||
            $tokens->isTokenKindFound(T_INTERFACE) ||
            $tokens->isTokenKindFound(T_TRAIT);
    }

    public function getName()
    {
        return 'Hoa/no_blank_lines_before_entity';
    }
}

<?php

/**
 * This file is part of Immutable package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Serafim\Immutable\Tests;

use PHPUnit\Framework\TestCase;
use Serafim\Immutable\Immutable;
use Serafim\Immutable\Exception\ContextException;
use Serafim\Immutable\Exception\IntegrityException;

/**
 * Class CloningTestCase
 */
class CloningTestCase extends TestCase
{
    /**
     * @return void
     */
    public function testStaticContext(): void
    {
        $this->expectException(IntegrityException::class);
        $this->expectExceptionMessage('Trying to clone an uncloneable object of class class@anonymous');
        $this->expectExceptionCode(1);

        $object = new class extends \Exception
        {
            public function test(): void
            {
                Immutable::execute(function () {
                    throw new \LogicException('This code should not have been executed');
                });
            }
        };

        $object->test();
    }
}

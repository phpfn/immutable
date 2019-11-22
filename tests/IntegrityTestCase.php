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

/**
 * Class IntegrityTestCase
 */
class IntegrityTestCase extends TestCase
{
    /**
     * @var int
     */
    private $value = 42;

    /**
     * @return void
     */
    public function testObjectIsCopy(): void
    {
        $self = Immutable::execute(function () {
            $this->value = 23;
        });

        $this->assertNotSame($this, $self, 'Immutable object should be the same');
    }

    /**
     * @return void
     */
    public function testValueHasBeenChanged(): void
    {
        $self = Immutable::execute(function () {
            $this->value = 23;
        });

        $this->assertNotSame($this->value, $self->value, 'Value of new object should be changed');
    }

    /**
     * @return void
     */
    public function testChangedValues(): void
    {
        $self = Immutable::execute(function () {
            $this->value = 23;
        });

        $this->assertSame($this->value, 42, 'Old value should be equal with 42');
        $this->assertSame($self->value, 23, 'New value should be equal with 23');
    }
}

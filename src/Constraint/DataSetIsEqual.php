<?php
/*
 * This file is part of DbUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\DbUnit\Constraint;

use PHPUnit\DbUnit\DataSet\IDataSet;
use PHPUnit\DbUnit\InvalidArgumentException;
use PHPUnit\Framework\Constraint\Constraint;

/**
 * Asserts whether or not two dbunit datasets are equal.
 */
class DataSetIsEqual extends Constraint
{
    /**
     * @var IDataSet
     */
    protected $value;

    /**
     * @var string
     */
    protected $failure_reason;

    /**
     * Creates a new constraint.
     *
     * @param IDataSet $value
     */
    public function __construct(IDataSet $value)
    {
        $this->value = $value;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString(): string
    {
        return \sprintf(
            'is equal to expected %s',
            $this->value->__toString()
        );
    }

    /**
     * Evaluates the constraint for parameter $other. Returns TRUE if the
     * constraint is met, FALSE otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
     * @param mixed $other value or object to evaluate
     *
     * @return bool
     */
    protected function matches($other): bool
    {
        if (!$other instanceof IDataSet) {
            throw new InvalidArgumentException(
                'PHPUnit\DbUnit\DataSet\IDataSet expected'
            );
        }

        return $this->value->matches($other);
    }

    /**
     * Returns the description of the failure
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * @param mixed $other evaluated value or object
     *
     * @return string
     */
    protected function failureDescription($other): string
    {
        return $other->__toString() . ' ' . $this->toString();
    }
}

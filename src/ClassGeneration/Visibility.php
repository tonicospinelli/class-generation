<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration;

/**
 * @author Antonio Spinelli <tonicospinelli@gmail.com>
 */
class Visibility
{

    const TYPE_PUBLIC = 'public';

    const TYPE_PRIVATE = 'private';

    const TYPE_PROTECTED = 'protected';

    /**
     * Validate visiblity.
     *
     * @param string $visibility
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public static function isValid($visibility)
    {
        switch ($visibility) {
            case Visibility::TYPE_PRIVATE:
            case Visibility::TYPE_PROTECTED:
            case Visibility::TYPE_PUBLIC:
                return true;
        }
        throw new \InvalidArgumentException('The ' . $visibility . ' is not allowed');
    }
}

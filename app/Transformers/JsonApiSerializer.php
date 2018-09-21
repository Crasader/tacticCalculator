<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Transformers;

use League\Fractal\Resource\ResourceInterface;

class JsonApiSerializer extends \League\Fractal\Serializer\JsonApiSerializer
{
    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array $data
     *
     * @return array
     */
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return [];
    }
}

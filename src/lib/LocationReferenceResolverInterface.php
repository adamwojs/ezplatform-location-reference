<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference;

use eZ\Publish\API\Repository\Values\Content\Location;

interface LocationReferenceResolverInterface
{
    public function resolve(string $reference): Location;
}

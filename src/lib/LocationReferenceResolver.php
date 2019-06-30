<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference;

use AdamWojs\EzPlatformLocationReference\ExpressionLanguage\ExpressionLanguage;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\Values\Content\Location;

final class LocationReferenceResolver implements LocationReferenceResolverInterface
{
    /** @var \eZ\Publish\API\Repository\LocationService */
    private $locationService;

    /** @var \Symfony\Component\ExpressionLanguage\ExpressionLanguage */
    private $expressionLanguage;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function resolve(string $reference): Location
    {
        return $this->expressionLanguage->evaluate($reference, [
            'location_service' => $this->locationService,
        ]);
    }
}

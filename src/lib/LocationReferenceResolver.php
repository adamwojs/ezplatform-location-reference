<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference;

use AdamWojs\EzPlatformLocationReference\ExpressionLanguage\ExpressionLanguage;
use eZ\Publish\API\Repository\Values\Content\Location;

final class LocationReferenceResolver implements LocationReferenceResolverInterface
{
    /** @var \eZ\Publish\API\Repository\LocationService */
    private $limitedLocationService;

    /** @var \Symfony\Component\ExpressionLanguage\ExpressionLanguage */
    private $expressionLanguage;

    public function __construct(LimitedLocationService $limitedLocationService, ExpressionLanguage $expressionLanguage)
    {
        $this->limitedLocationService = $limitedLocationService;
        $this->expressionLanguage = $expressionLanguage;
    }

    public function resolve(string $reference): Location
    {
        if ($this->isLocationId($reference)) {
            return $this->limitedLocationService->loadLocation((int)$reference);
        }

        return $this->expressionLanguage->evaluate($reference, [
            '__location_service' => $this->limitedLocationService,
        ]);
    }

    private function isLocationId(string $reference): bool
    {
        return ctype_digit($reference);
    }
}

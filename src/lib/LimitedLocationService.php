<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\Values\Content\Location;

/**
 * Limited location service which offers only load methods.
 *
 * @internal
 */
final class LimitedLocationService
{
    /** @var \eZ\Publish\API\Repository\LocationService */
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function loadLocation(int $locationId): Location
    {
        return $this->locationService->loadLocation($locationId);
    }

    public function loadLocationByRemoteId(string $remoteId): Location
    {
        return $this->locationService->loadLocationByRemoteId($remoteId);
    }

    public function loadLocationByPathString(string $path): Location
    {
        return $this->locationService->loadLocation(
            $this->extractIdFromPath($path)
        );
    }

    public function loadParentLocation(Location $location): Location
    {
        return $this->locationService->loadLocation($location->parentLocationId);
    }

    /**
     * Extracts location ID from path.
     *
     * @param string $path
     *
     * @return int
     */
    private function extractIdFromPath(string $path): int
    {
        $ids = explode('/', trim($path, '/'));

        return (int)end($ids);
    }
}

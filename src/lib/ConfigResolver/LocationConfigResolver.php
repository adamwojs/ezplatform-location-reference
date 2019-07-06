<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference\ConfigResolver;

use AdamWojs\EzPlatformLocationReference\LocationReference;
use AdamWojs\EzPlatformLocationReference\LocationReferenceResolverInterface;
use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\Core\MVC\ConfigResolverInterface;

final class LocationConfigResolver implements LocationConfigResolverInterface
{
    /** @var \eZ\Publish\Core\MVC\ConfigResolverInterface */
    private $configResolver;

    /** @var \AdamWojs\EzPlatformLocationReference\LocationReferenceResolverInterface */
    private $referenceResolver;

    public function __construct(
        ConfigResolverInterface $configResolver,
        LocationReferenceResolverInterface $referenceResolver
    ) {
        $this->configResolver = $configResolver;
        $this->referenceResolver = $referenceResolver;
    }

    public function getLocation(string $name, ?string $namespace = null, ?string $scope = null): Location
    {
        return $this->referenceResolver->resolve(
            $this->configResolver->getParameter($name, $namespace, $scope)
        );
    }

    public function getLocationReference(
        string $name,
        ?string $namespace = null,
        ?string $scope = null
    ): LocationReference {
        return new LocationReference(
            $this->referenceResolver,
            $this->configResolver->getParameter($name, $namespace, $scope)
        );
    }
}

<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference\NamedReferences;

use eZ\Publish\Core\MVC\ConfigResolverInterface;

final class NamedReferencesProvider implements NamedReferencesProviderInterface
{
    /** @var \eZ\Publish\Core\MVC\ConfigResolverInterface */
    private $configResolver;

    public function __construct(ConfigResolverInterface $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    public function getNamedReferences(): NamedReferencesCollection
    {
        return new NamedReferencesCollection(
            $this->configResolver->getParameter('location_references')
        );
    }
}

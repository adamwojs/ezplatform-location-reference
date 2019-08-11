<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference\Tests\Stubs;

use AdamWojs\EzPlatformLocationReference\NamedReferences\NamedReferencesCollection;
use AdamWojs\EzPlatformLocationReference\NamedReferences\NamedReferencesProviderInterface;

final class NamedReferencesProviderStub implements NamedReferencesProviderInterface
{
    private $namedReferences = [];

    public function __construct(array $references = [])
    {
        $this->namedReferences = $references;
    }

    public function getNamedReferences(): NamedReferencesCollection
    {
        return new NamedReferencesCollection($this->namedReferences);
    }
}

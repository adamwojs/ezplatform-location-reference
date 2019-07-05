<?php

namespace AdamWojs\EzPlatformLocationReference\NamedReferences;

interface NamedReferencesProviderInterface
{
    public function getNamedReferences(): NamedReferencesCollection;
}

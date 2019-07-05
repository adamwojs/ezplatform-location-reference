<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReferenceBundle;

use AdamWojs\EzPlatformLocationReferenceBundle\DependencyInjection\Configuration\Parser\LocationReferenceConfigParser;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class EzPlatformLocationReferenceBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        /** @var \eZ\Bundle\EzPublishCoreBundle\DependencyInjection\EzPublishCoreExtension $core */
        $core = $container->getExtension('ezpublish');
        $core->addDefaultSettings(__DIR__ . '/Resources/config', ['defaults.yaml']);
        $core->addConfigParser(new LocationReferenceConfigParser());
    }
}

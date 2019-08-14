<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReferenceBundle\Tests\DependencyInjection\Configuration\Parser;

use AdamWojs\EzPlatformLocationReferenceBundle\DependencyInjection\Configuration\Parser\LocationReferenceConfigParser;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\EzPublishCoreExtension;
use eZ\Bundle\EzPublishCoreBundle\Tests\DependencyInjection\Configuration\Parser\AbstractParserTestCase;

final class LocationReferenceConfigParserTest extends AbstractParserTestCase
{
    protected function getContainerExtensions(): array
    {
        return [
            new EzPublishCoreExtension([
                new LocationReferenceConfigParser(),
            ]),
        ];
    }

    /**
     * @dataProvider dataProviderForSettings
     */
    public function testSettings(array $config, array $expected): void
    {
        $this->load([
            'system' => [
                'ezdemo_site' => $config,
            ],
        ]);

        foreach ($expected as $key => $val) {
            $this->assertConfigResolverParameterValue($key, $val, 'ezdemo_site');
        }
    }

    public function dataProviderForSettings(): array
    {
        return [
            [
                [],
                ['location_references' => []],
            ],
            [
                [
                    'location_references' => [
                        'foo' => 'remote_id("babe4a915b1dd5d369e79adb9d6c0c6a")',
                        'bar' => 'root()',
                    ],
                ],
                [
                    'location_references' => [
                        'foo' => 'remote_id("babe4a915b1dd5d369e79adb9d6c0c6a")',
                        'bar' => 'root()',
                    ],
                ],
            ],
        ];
    }
}

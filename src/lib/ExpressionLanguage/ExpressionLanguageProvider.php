<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference\ExpressionLanguage;

use eZ\Publish\API\Repository\Values\Content\Location;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

final class ExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions(): array
    {
        return [
            new ExpressionFunction(
                'remote_id',
                function (string $args): string {
                    return sprintf('$__location_service->loadLocationByRemoteId(%s)', $args);
                },
                function (array $variables, string $remoteId): Location {
                    return $variables['__location_service']->loadLocationByRemoteId($remoteId);
                }
            ),
            new ExpressionFunction(
                'local_id',
                function (string $args): string {
                    return sprintf('$__location_service->loadLocation(%s)', $args);
                },
                function (array $variables, int $id): Location {
                    return $variables['__location_service']->loadLocation($id);
                }
            ),
            new ExpressionFunction(
                'path',
                function (string $args): string {
                    return sprintf('$__location_service->loadLocationByPath(%s)', $args);
                },
                function (array $variables, string $path): Location {
                    return $variables['__location_service']->loadLocationByPath($path);
                }
            ),
            new ExpressionFunction(
                'parent',
                function (string $args): string {
                    return sprintf('$__location_service->loadParentLocation(%s)', $args);
                },
                function (array $variables, Location $location): Location {
                    return $variables['__location_service']->loadParentLocation($location);
                }
            ),
            new ExpressionFunction(
                'root',
                function (string $args): string {
                    return sprintf('$__location_service->loadRootLocation(%s)', $args);
                },
                function (array $variables): Location {
                    return $variables['__location_service']->loadRootLocation();
                }
            ),
        ];
    }
}

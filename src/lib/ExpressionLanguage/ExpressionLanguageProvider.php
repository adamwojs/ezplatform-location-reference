<?php

declare(strict_types=1);

namespace AdamWojs\EzPlatformLocationReference\ExpressionLanguage;

use eZ\Publish\API\Repository\Exceptions\NotImplementedException;
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
                    return sprintf('$location_service->loadLocationByRemoteId(%s)', $args);
                },
                function (array $variables, string $remoteId): Location {
                    return $variables['location_service']->loadLocationByRemoteId($remoteId);
                }
            ),
            new ExpressionFunction(
                'local_id',
                function (string $args): string {
                    return sprintf('$location_service->loadLocation(%s)', $args);
                },
                function (array $variables, int $id): Location {
                    return $variables['location_service']->loadLocation($id);
                }
            ),
            new ExpressionFunction(
                'path',
                function (string $args): string {
                    throw new NotImplementedException('path function compiler is not implemented');
                },
                function (array $variables, string $path) {
                    $locationId = explode('/', trim($path, '/'));
                    $locationId = array_slice($locationId, 0, count($locationId) - 1);

                    return $variables['location_service']->loadLocation($locationId);
                }
            ),
            new ExpressionFunction(
                'parent',
                function (string $args): string {
                    throw new NotImplementedException('parent function compiler is not implemented');
                },
                function (array $variables, Location $location): Location {
                    return $variables['location_service']->loadLocation($location->parentLocationId);
                }
            ),
            new ExpressionFunction(
                'root',
                function (string $args): string {
                    throw new NotImplementedException('root function compiler is not implemented');
                },
                function (array $variables): Location {
                    throw new NotImplementedException('root function evaluator is not implemented');
                }
            ),
        ];
    }
}

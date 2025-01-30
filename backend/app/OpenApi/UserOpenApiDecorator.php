<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Info;
use ApiPlatform\OpenApi\Model\Parameter;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\Model\Response;
use ApiPlatform\OpenApi\Model\Server;
use ApiPlatform\OpenApi\OpenApi;
use ArrayObject;

/**
 * @brief Class to override the OpenAPI specification of the "users" API route.
 */
class UserOpenApiDecorator implements OpenApiFactoryInterface {
    public function __construct(
        private OpenApiFactoryInterface $decorated,
    ) {}

    public function __invoke(array $context = []): OpenApi {
        $openApi = $this->decorated->__invoke($context);
        $openApi = $this->overrideLoginRoute($openApi);
        return $openApi;
    }

    private function overrideLoginRoute(OpenApi $openApi): OpenApi {
        $route = '/api/login';

        $pathItem = $openApi->getPaths()->getPath($route);
        $operation = $pathItem->getPost();

        $loginSchema = [
            'email' => ['type' => 'string', 'description' => 'The email of the user'],
            'password' => ['type' => 'string', 'description' => 'The password of the user'],
            'device_name' => [
                'type' => 'string',
                'description' => 'An arbitrary identifier for the device.',
            ],
        ];

        $loginBodyExample = [
            'email' => 'john.doe@gmail.com',
            'password' => 'SecurePassword',
            'device_name' => "Joe's smarthphone",
        ];

        $requestBody = new RequestBody(content: new ArrayObject([
            'application/ld+json' => [
                'schema' => $loginSchema,
                'example' => $loginBodyExample,
            ]
        ]));

        $requestSchema = ['application/json' => [
            'schema' => [
                'type' => 'object',
                'properties' => [
                    'message' => ['type' => 'string', 'description' => 'The message indicating the status of the request'],
                    'token' => ['type' => 'string', 'description' => 'The auth token'],
                ],
            ],
            'example' => [
                'message' => 'success',
                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM',
            ],
        ]];

        $responses  = [
            '200' => new Response('Ok', content: new ArrayObject($requestSchema)),
        ];

        $operation = $operation
            ->withRequestBody($requestBody)
            ->withResponses($responses)
        ;

        $openApi->getPaths()->addPath($route, $pathItem->withPost($operation));

        return $openApi;
    }
}
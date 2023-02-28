<?php

namespace App\OpenApi;
use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{

    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
       $openApi = $this->decorated->__invoke($context);

        /** @var PathItem $path */
       foreach($openApi->getPaths()->getPaths() as $key => $path) {
           if($path->getGet() && $path->getGet()->getSummary() === 'hidden'){
                $openApi->getPaths()->addPath($key, $path->withGet(null));
           }
       }

       $schemas = $openApi->getComponents()->getSecuritySchemes();
       $schemas['bearerAuth'] = new \ArrayObject([
           'type' => 'http',
           'scheme' => 'bearer',
           'bearerFormat' => 'JWT',
       ]);

       $schema = $openApi->getComponents()->getSchemas();
       $schema['Token'] = new \ArrayObject([
           'type' => 'object',
           'properties' => [
               'token' => [
                   'type' => 'string',
                   'readOnly' => 'true',
               ],
           ],

       ]);

       $schema['Credentials'] = new \ArrayObject([
           'type' => 'object',
           'properties' => [
               'username' => [
                   'type' => 'string',
                   'example' => 'john@doe.fr'
               ],
               'password' => [
                   'type' => 'string',
                   'example' => 'string'
               ],
           ],
       ]);

       $meOperation = $openApi->getPaths()->getPath('/api/me')->getGet()->withParameters([]);
       $mePathItem = $openApi->getPaths()->getPath('/api/me')->withGet($meOperation);
       $openApi->getPaths()->addPath('/api/me', $mePathItem);

       $pathItem = new PathItem(
           post: new Operation(
               operationId: 'postApiLogin',
               tags: ['Authentification'],
               responses: [
                   '200' => [
                       'description' => 'Token JWT',
                       'content' => [
                           'application/json' => [
                               'schema' => [
                                   '$ref' => '#/components/schemas/Token',
                               ]
                           ]
                       ]
                   ]
               ],
               requestBody: new RequestBody(
                   content: new \ArrayObject([
                       'application/json' => [
                           'schema' => [
                               '$ref' => '#/components/schemas/Credentials'
                           ]
                       ]
                   ])
               )
           )
       );
       $openApi->getPaths()->addPath('/api/login', $pathItem);

       return $openApi;
    }

}


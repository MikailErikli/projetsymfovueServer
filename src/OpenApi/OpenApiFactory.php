<?php


namespace App\OpenApi;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    /**
     * @var OpenApiFactoryInterface
     */
    private $decorated;
    public function __construct(OpenApiFactoryInterface $decorated){
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
       $openApi = $this->decorated->__invoke($context);

       $schemas = $openApi->getComponents()->getSecuritySchemes();
       $schemas['cookieAuth']= new \ArrayObject([
           'type' => 'apiKey',
           'in' => 'cookie',
           'name' => 'PHPSESSID'
       ]);



     $schemas = $openApi->getComponents()->getSchemas();
     $schemas['Credentials'] = new \ArrayObject([
         'type' => 'object',
         'properties' => [
             'username' => [
                 'type' => 'string',
                 'example' => 'john@doe.fr',
             ],
             'password' => [
                 'type' => 'string',
                 'example' => '0000'
             ]
         ]
     ]);




       return $openApi;
    }
}
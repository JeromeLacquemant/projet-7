<?php
declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function respond($response, $codeHttp)
    {        
    return
        new JsonResponse(
            $this->serializer->serialize($response, 'json'),
            $codeHttp,
            [],
            true
        );
    }
}
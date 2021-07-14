<?php

namespace App\Output\OutputConstructors;

use App\Output\Outputs\UserOutput;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserValidationOutputConstruction
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator) 
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function outputConstruction($request)
    {
        $userDTO = $this->serializer->deserialize(
            $request->getContent(), 
            UserOutput::class,
            'json'
        );

        $violations = $this->validator->validate($userDTO);
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                if ($violation instanceof ConstraintViolation) {
                    $message = $violation->getMessage();
                    $messages[] = $message;
                }
            }
            return [$messages, 400];
        }
        return $userDTO;
    }
}
<?php

namespace App\Dto;

use App\Dto\UserResponseDto;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomerUserResponseDto
{
    private $validator;

    public function __construct(
        ValidatorInterface $validator
        ) 
    {
        $this->validator = $validator;
    }

    public function transformFromObject($user)
    {
        $violations = $this->validator->validate($user);

        if (count($violations) > 0) {
            foreach ($violations as $violation) {
               if ($violation instanceof ConstraintViolation) {
                    $message = $violation->getMessage();
                    $messages[] = $message;
                }
            }
            return [$messages, 400];
        }

        $dto = new UserResponseDto();

        $dto->username = $user['username'];
        $dto->password = $user['password'];
        $dto->email = $user['email'];

        return $dto;
        
    }
}
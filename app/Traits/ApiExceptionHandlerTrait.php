<?php
/**
 * Created by PhpStorm.
 * User: frankj
 * Date: 5/4/17
 * Time: 7:14 PM
 */

namespace App\Traits;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ApiExceptionHandlerTrait
{
    /**
     * Response status code
     *
     * @var int
     */
    protected $statusCode = HttpFoundationResponse::HTTP_OK;

    /**
     * Response errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Sets the statusCode for the response
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Returns the current statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Exception $exception)
    {
        switch (true) {
            case $this->isValidationException($exception):
                return $response = $this->respondFailedValidation($exception);
            case $this->isModelNotFoundException($exception):
                return $response = $this->respondNotFound();
            case $this->isHttpException($exception):
                return $response = $this->respondWithHttpException($exception);
            case $this->isAuthenticationException($exception):
                return $response = $this->respondWithAuthenticationException($exception);
            default:
                return $response = $this->respondBadRequest($exception);
        }
    }

    /**
     * Returns a json response for HttpException.
     *
     * @param Exception $exception
     * @return mixed
     */
    public function respondWithHttpException($exception)
    {
        return $this->setStatusCode($exception->getStatusCode())
            ->withError($exception->getMessage())
            ->respond();
    }

    /**
     * Returns a json response for HttpException.
     *
     * @param Exception $exception
     * @return mixed
     */
    public function respondWithAuthenticationException($exception)
    {
        return $this->setStatusCode(HttpFoundationResponse::HTTP_UNAUTHORIZED)
            ->withError($exception->getMessage())
            ->respond();
    }

    /**
     * Returns a json response for UnsuportedJsonRequestException.
     *
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseUnsoportedJsonRequest($exception)
    {
        return $this->setStatusCode(HttpFoundationResponse::HTTP_FORBIDDEN)
            ->withValidationErrors($exception)
            ->respond();
    }

    /**
     * Returns a jsons error response with validation errors
     *
     * @param ValidationException $exception
     * @return mixed
     */
    public function respondFailedValidation($exception)
    {
        return $this->setStatusCode(HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->withValidationErrors($exception)
            ->respond();
    }

    /**
     * Returns a json response for generic bad request.
     *
     * @param Exception $exception
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondBadRequest($exception, $message = 'Bad request')
    {
        if (env('APP_DEBUG') === true) {
            return $this->setStatusCode(HttpFoundationResponse::HTTP_BAD_REQUEST)
                ->withError($exception->getMessage())
                ->respond();
        }

        return $this->setStatusCode(HttpFoundationResponse::HTTP_BAD_REQUEST)
            ->withError($message)
            ->respond();
    }

    /**
     * Returns json response for model not found.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = 'Not found')
    {
        return $this->setStatusCode(HttpFoundationResponse::HTTP_NOT_FOUND)
            ->withError($message)
            ->respond();
    }

    /**
     * Returns json response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond()
    {
        $payload['errors'] = $this->errors ?: [];

        return response()->json($payload, $this->getStatusCode());
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $exception
     * @return bool
     */
    protected function isModelNotFoundException(Exception $exception)
    {
        return $exception instanceof ModelNotFoundException;
    }

    /**
     * Determines if the given exception is a ValidationException.
     *
     * @param Exception $exception
     * @return bool
     */
    protected function isValidationException(Exception $exception)
    {
        return $exception instanceof ValidationException;
    }

    /**
     * Determines if the given exception is a HttpException.
     *
     * @param Exception $exception
     * @return bool
     */
    protected function isHttpException(Exception $exception)
    {
        return $exception instanceof HttpException;
    }

    /**
     * Determines if the given exception is a HttpException.
     *
     * @param Exception $exception
     * @return bool
     */
    protected function isAuthenticationException(Exception $exception)
    {
        return $exception instanceof AuthenticationException;
    }

    /**
     * Returns a single error response entry
     *
     * @param string $title
     * @param string $detail
     * @param array $source
     * @return mixed
     */
    protected function getErrorResponseEntry($title, $detail = "", $source = [])
    {
        if (!$source) {
            $source = ["pointer" => ''];
        }

        return [
            'status' => (string)$this->getStatusCode(),
            'source' => $source,
            'title' => $title,
            'detail' => $detail,
        ];
    }

    /**
     * Extracts the validation errors provided by the ValidationException
     *
     * @param $exception
     * @return array
     */
    protected function extractValidationErrors($exception)
    {
        $responseData = [];

        $validationErrors = json_decode($exception->validator->getMessageBag());

        foreach ($validationErrors as $fieldName => $errorData) {
            $responseData = array_merge($responseData, $this->extractErrorMessage($fieldName, $errorData));
        }
        return $responseData;
    }

    /**
     * Extracts the error messages for a single validation error
     *
     * @param $fieldName
     * @param $errorData
     * @return array
     */
    protected function extractErrorMessage($fieldName, $errorData)
    {
        $extractErrorMessages = [];

        if (is_array($errorData)) {
            foreach ($errorData as $error) {
                $extractErrorMessages[] = $this->getErrorResponseEntry(
                    'Invalid parameter',
                    $error,
                    ["pointer" => "/data/attributes/{$fieldName}"]
                );
            }

            return $extractErrorMessages;
        }

        $extractErrorMessages[] = $this->getErrorResponseEntry(
            'Invalid parameter',
            $errorData,
            ["pointer" => "/data/attributes/{$fieldName}"]
        );
        return $extractErrorMessages;
    }

    /**
     * Adds an error to the response errors
     *
     * @param $message
     * @return $this
     */
    protected function withError($message)
    {
        $this->errors[] = $this->getErrorResponseEntry($message);
        return $this;
    }

    /**
     * Adds the validation errors provided by the ValidationException to the response errors
     *
     * @param $exception
     * @return $this
     */
    protected function withValidationErrors($exception)
    {
        $this->errors = array_merge($this->errors, $this->extractValidationErrors($exception));
        return $this;
    }
}

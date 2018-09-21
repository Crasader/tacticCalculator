<?php

namespace App\Transformers;

class AttributesToRelationships extends JsonApiSerializer
{
    /**
     * @see \League\Fractal\Serializer\JsonApiSerializer::parseRelationships()
     */
    protected function parseRelationships($includedData)
    {
        $relationships = [];

        foreach ($includedData as $key => $inclusion) {
            foreach ($inclusion as $includeKey => $includeObject) {
                $relationships = $this->buildRelationships($includeKey, $relationships, $includeObject, $key);
            }
        }

        return $relationships;
    }

    /**
     * @see \League\Fractal\Serializer\JsonApiSerializer::buildRelationships()
     */
    private function buildRelationships($includeKey, $relationships, $includeObject, $key)
    {
        if (!array_key_exists($includeKey, $relationships)) {
            $relationships[$includeKey] = [];
        }

        $relationship = $this->getRelationshipElement($includeObject);

        $relationships[$includeKey][$key] = $relationship;

        return $relationships;
    }

    private function getRelationshipElement($includeObject)
    {
        if ($this->isNull($includeObject)) {
            return $this->null();
        } elseif ($this->isEmpty($includeObject)) {
            return [
                'data' => [],
            ];
        } elseif ($this->isCollection($includeObject)) {
            $relationship = ['data' => []];

            foreach ($includeObject['data'] as $object) {
                $relationship['data'][] = [
                    'type' => $object['type'],
                    'id' => $object['id'],
                    'attributes' => $object['attributes'],
                ];
            }
            return $relationship;
        }
        return [
            'data' => [
                'type' => $includeObject['data']['type'],
                'id' => $includeObject['data']['id'],
                'attributes' => $includeObject['data']['attributes'],
            ],
        ];
    }
}

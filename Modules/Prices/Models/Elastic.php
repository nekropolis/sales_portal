<?php

namespace Modules\Prices\Models;


use Elasticsearch\ClientBuilder;
use Modules\Products\Models\Products;

class Elastic
{
    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts(config('database.connections.elasticsearch.hosts'))->build();
    }

    public function getProductIds($query)
    {
        if (!$this->client->indices()->exists(['index' => 'products'])) {
            Products::createIndex();
        }
        $params = [
            'index' => 'products',
            'size'  => 5,
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query'     => $query,
                        'fields'    => ['model'],
                        'fuzziness' => 'AUTO',
                    ],
                ],
            ],
        ];

        try {
            $response = $this->client->search($params);
        } catch (\Throwable $e) {
            // Handle the exception
            return [];
        }

        return array_column($response['hits']['hits'], '_id');
    }

}
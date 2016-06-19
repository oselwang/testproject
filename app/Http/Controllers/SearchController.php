<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    private $request;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function show()
    {
        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://localhost:9200'])
            ->build();
        $search = $this->request->query->get('q');

        $params = [
            'index' => 'recipe',
            'type'  => 'recipe',
            'from'  => 0,
            'size'  => 3,
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $search,

                                'fields' => [
                                    'name^2'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $data = $client->search($params);
        
        $hits = $data['hits']['hits'];

        return view('search',compact('hits','search'));

    }
}

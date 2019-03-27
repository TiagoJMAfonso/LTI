<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;


class OnosController extends Controller
{
    // $client = '';  
    // $auth = '';

    // public function login(Request $request)
    // {
        
    //     $client = new Client([
    //     // Base URI is used with relative requests
    //     'base_uri' => '$request->uri',
    //     // You can set any number of default request options.
    //     'timeout' => 2.0,
    //     ]);  
    //     $auth = ['auth' =>
    //             [
    //                 '$request->username',
    //                 '$request->password'
    //             ]
    //         ];
        
    // }

    public function devices(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'devices',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $devices = json_decode($response->getBody()->getContents());
        return response()->json($devices);
    }

    public function getLinks(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'links',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $links = json_decode($response->getBody()->getContents());
        return response()->json($links);
    }

    public function getHosts(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'hosts',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $hosts = json_decode($response->getBody()->getContents());
        return response()->json($hosts);
    }
    public function getTopology(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'system',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $topo = json_decode($response->getBody()->getContents());
        return response()->json($topo);
    }
    public function getIntents(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'intents',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $devices = json_decode($response->getBody()->getContents());
        return response()->json($devices);
    }


    public function getFlows(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.56.102:8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'flows',
            ['auth' =>
                [
                    'onos',
                    'rocks'
                ]
            ]
        );
        $flows = json_decode($response->getBody()->getContents());
        return response()->json($flows);
    }

}

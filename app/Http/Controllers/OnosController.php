<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use PhpParser\Node\Expr\Cast\Object_;


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
        //dd($request->ip, $request->username, $request->password);
        /*$data = $request->validate([
            'table_number' => 'required|min:1|numeric|unique:restaurant_tables,table_number'
        ]);*/
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'devices',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $devices = json_decode($response->getBody()->getContents());
        return response()->json($devices);
    }


    public function getDevicesById(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'deviceId' => 'required'
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'devices/' . $data['deviceId'] . '/ports',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $devices = json_decode($response->getBody()->getContents());
        //dd($devices);
        return response()->json($devices);
    }

    public function getLinks(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'links',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $links = json_decode($response->getBody()->getContents());
        return response()->json($links);
    }

    public function getHosts(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'hosts',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $hosts = json_decode($response->getBody()->getContents());
        return response()->json($hosts);
    }

    public function getTopology(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'system',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $topo = json_decode($response->getBody()->getContents());
        return response()->json($topo);
    }

    public function getIntents(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'intents',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $devices = json_decode($response->getBody()->getContents());
        return response()->json($devices);
    }


    public function getFlows(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'flows',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $flows = json_decode($response->getBody()->getContents());
        return response()->json($flows);
    }


    public function addIntents(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'macO' => 'required',
            'macS' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('POST', 'intents',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ],
                'body' =>
                    '{
                         "type": "HostToHostIntent",
                         "appId": "org.onosproject.ovsdb",
                         "priority": 55,
                         "one": "'.$request->macO.'/-1",
                         "two": "'.$request->macS.'/-1"
                    }'
            ]

        );

        $intents = json_decode($response->getStatusCode());
        return response()->json($intents);
    }

    public function deleteIntent(Request $request)
    {

        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'key' => 'required',
            'appId' => 'required',
        ]);

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('DELETE', 'intents/'.$data['appId'].'/'.$data['key'],
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]

        );

        $intents = json_decode($response->getStatusCode());
        return response()->json($intents);
    }

    public function getApplications(Request $request)
    {
        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'applications',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]
        );
        $flows = json_decode($response->getBody()->getContents());
        return response()->json($flows);
    }

    public function activeApp(Request $request)
    {

        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'appName' => 'required',
        ]);

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('POST', 'applications/' . $data['appName'] . '/active',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]

        );
        $applications = json_decode($response->getStatusCode());
        return response()->json($applications);
    }

    public function deactivateApp(Request $request)
    {

        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'appName' => 'required',
        ]);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('DELETE', 'applications/' . $data['appName'] . '/active',
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]

        );
        $applications = json_decode($response->getStatusCode());
        return response()->json($applications);
    }

    public function deleteFlows(Request $request)
    {

        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'flowId' => 'required',
            'deviceId' => 'required',
        ]);

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('DELETE', 'flows/'.$data['deviceId'].'/'.$data['flowId'],
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]

        );

        $flows = json_decode($response->getStatusCode());
        return response()->json($flows);
    }

    public function getStatByDevice(Request $request)
    {

        $data = $request->validate([
            'ip' => 'required|ipv4',
            'username' => 'required',
            'password' => 'required',
            'selected' => 'required',
        ]);

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://' . $data['ip'] . ':8181/onos/v1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET', 'statistics/ports/'.$data['selected'],
            ['auth' =>
                [
                    $data['username'],
                    $data['password']
                ]
            ]

        );

        $stats = json_decode($response->getBody()->getContents());



       // dd(array_values((array)$stats->statistics[0]->ports[0]));//values
       // dd(array_keys((array)$stats->statistics[0]->ports[0]));//optios



        return response()->json([array_keys((array)$stats->statistics[0]->ports[0]),array_values((array)$stats->statistics[0]->ports[0])]);
    }
}

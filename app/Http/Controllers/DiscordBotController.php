<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DiscordBotController extends Controller
{
    public function broadcast(Request $request)
    {
        $webhookUrl = 'https://discord.com/api/webhooks/1234888722391109712/MFQE_6mVi1ROVCTQgJmGuV5nKojCIXggHOmwptwqi9f55io7FLYb5hRrRVg8y3L8Si3Y';
        $message = $request->input('message');
        $image_url = 'https://d1gtq9mqg5x3oe.cloudfront.net/hermes/images/news/insights/2022/06-june/07-barbecue-science/promo/barbecue-science-promo-3840x2160.jpg';

        $payload = [
            'content' => $message,
            'embeds' => [
                [
                    'image' => [
                        'url' => $image_url
                    ]
                ]
            ]
        ];

        $response = Http::post($webhookUrl, $payload);


        return response()->json($response->json());
    }
}

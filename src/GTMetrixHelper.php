<?php

namespace Marshmallow\GTMetrix;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Marshmallow\GTMetrix\GTMetrixClient;
use Entrecore\GTMetrixClient\GTMetrixTest;

class GTMetrixHelper
{
    public function getScore(Model $model)
    {
        if (!method_exists($model, 'gtmetrixable')) {
            throw new Exception('This resource does have a method of gtmetrixable(). Maybe you are not using the trait "GTMetrix"');
        }

        if (!method_exists($model, 'getFullPublicPath')) {
            throw new Exception('This resource does have a method of getFullPublicPath(). Maybe you are not using the trait "GTMetrix"');
        }

        if (!config('gtmetrix.email_address')) {
            throw new Exception('Please provide your GTmetrix email address in your config of .env file');
        }

        if (!config('gtmetrix.api_key')) {
            throw new Exception('Please provide your GTmetrix api key in your config of .env file');
        }

        $path = $model->getFullPublicPath();

        $client = new GTMetrixClient();
        $client->setEndpoint(
            config('gtmetrix.api_endpoint')
        );
        $client->setUsername(
            config('gtmetrix.email_address')
        );
        $client->setAPIKey(
            config('gtmetrix.api_key')
        );

        $test = $client->startTest($path);

        while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
            $test->getState() != GTMetrixTest::STATE_ERROR) {
            $client->getTestStatus($test);
            sleep(5);
        }

        $model->gtmetrixable()->create([
            'path' => $path,
            'gtmetrix_id' => $test->getId(),
            'poll_state_url' => $test->getPollStateUrl(),
            'state' => $test->getState(),
            'error' => $test->getError(),
            'report_url' => $test->getReportUrl(),
            'pagespeed_score' => $test->getPagespeedScore(),
            'yslow_score' => $test->getYslowScore(),
            'html_bytes' => $test->getHtmlBytes(),
            'html_load_time' => $test->getHtmlLoadTime(),
            'page_bytes' => $test->getPageBytes(),
            'page_load_time' => $test->getPageLoadTime(),
            'page_elements' => $test->getPageElements(),
            'redirect_duration' => $test->getRedirectDuration(),
            'connect_duration' => $test->getConnectDuration(),
            'backend_duration' => $test->getBackendDuration(),
            'first_paint_time' => $test->getFirstPaintTime(),
            'dom_interactive_time' => $test->getDomInteractiveTime(),
            'dom_content_loaded_time' => $test->getDomContentLoadedTime(),
            'dom_content_loaded_duration' => $test->getDomContentLoadedDuration(),
            'onload_time' => $test->getOnloadTime(),
            'onload_duration' => $test->getOnloadDuration(),
            'fully_loaded_time' => $test->getFullyLoadedTime(),
            'rum_speed_index' => $test->getRumSpeedIndex(),
            'resources_report_pdf' => $test->getResources()['report_pdf'],
            'resources_pagespeed' => $test->getResources()['pagespeed'],
            'resources_har' => $test->getResources()['har'],
            'resources_pagespeed_files' => $test->getResources()['pagespeed_files'],
            'resources_report_pdf_full' => $test->getResources()['report_pdf_full'],
            'resources_yslow' => $test->getResources()['yslow'],
            'resources_screenshot' => $test->getResources()['screenshot'],
            'created_at' => now(),
        ]);

        $this->getAccountStatus();
    }

    public function getCredits()
    {
        $json = $this->getStatusJson();
        return $json->api_credits;
    }

    public function getCreditRefillDate()
    {
        $json = $this->getStatusJson();
        return Carbon::parse($json->api_refill);
    }

    public function getStatusJson()
    {
        if (!file_exists($this->statusFilePath())) {
            $this->getAccountStatus();
        }

        return json_decode(file_get_contents($this->statusFilePath()));
    }

    public function getAccountStatus()
    {
        if (!config('gtmetrix.email_address')) {
            throw new Exception('Please provide your GTmetrix email address in your config of .env file');
        }

        if (!config('gtmetrix.api_key')) {
            throw new Exception('Please provide your GTmetrix api key in your config of .env file');
        }

        $response = Http::withBasicAuth(
            config('gtmetrix.email_address'),
            config('gtmetrix.api_key')
        )->get(
            config('gtmetrix.api_endpoint') . 'status'
        );

        if ($response->ok()) {
            file_put_contents(
                $this->statusFilePath(),
                json_encode($response->json())
            );
        }
    }

    protected function statusFilePath()
    {
        return config('gtmetrix.account_status_storage');
    }
}

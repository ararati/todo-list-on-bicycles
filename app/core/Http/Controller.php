<?php

namespace App\Core\Http;

use App\Core\Http\Response\ResponseTemplate;

class Controller
{
    protected $baseTemplate = null;

    protected function view($templateName, $templateData = [], $baseTemplate = '')
    {
        $baseTemplate = $baseTemplate ? $baseTemplate : $this->baseTemplate;
        $response = new ResponseTemplate($templateName, $templateData, $baseTemplate);
        $response->render();
    }

    protected function redirect($relativeUrl = '')
    {
        $this->resolveRedirect($this->resolveRelativeUrl($relativeUrl));
    }

    protected function redirectBack()
    {
        $this->resolveRedirect($this->resolveBackUrl());
    }

    private function resolveRedirect($url)
    {
        header('Location: ' . $url);
        die();
    }

    private function resolveBackUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    private function resolveRelativeUrl($relative)
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'];
        $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $url .= $relative;

        return $url;
    }
}
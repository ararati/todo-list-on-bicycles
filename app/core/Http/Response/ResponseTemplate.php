<?php

namespace App\Core\Http\Response;

class ResponseTemplate extends Response
{
    private const CHILD_VIEW_KEY = 'childView';

    private const VIEWS_INCLUDE_PATH = '../app/views/';

    private $template;

    private $templateData;

    private $baseTemplate;

    public function __construct($templateName, $templateData, $baseTemplate = '')
    {
        $this->template = $this->formatFileName($templateName);

        if ($baseTemplate)
            $this->baseTemplate = $this->formatFileName($baseTemplate);

        $this->templateData = $this->formatTemplateData($templateData);
    }

    private function formatFileName($fileName)
    {
        return self::VIEWS_INCLUDE_PATH . $fileName . '.php';
    }

    private function formatTemplateData($templateData)
    {
        if ($this->baseTemplate) {
            return $this->addChildViewToData($this->template, $templateData);
        }

        return $templateData;
    }

    public function render()
    {
        $this->resolveRenderTemplate();
    }

    public function getViewIncludePath()
    {
        $templatePath = $this->baseTemplate ? $this->baseTemplate : $this->template;

        return $templatePath;
    }

    private function resolveRenderTemplate()
    {
        echo $this->getResponse($this->getViewIncludePath(), $this->templateData);
    }

    private function getResponse($templatePath, $templateData)
    {
        $level = ob_get_level();

        ob_start();

        try {
            $this->include($templatePath, $templateData);

            return trim(ob_get_clean());
        } catch (\Exception $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }

            throw $e;
        }
    }

    private function include($___templatePath, $___templateData)
    {
        extract($___templateData, EXTR_SKIP);

        include $___templatePath;
    }

    private function includeFromBase($baseTemplate, $templatePath, $templateData)
    {
        $templateData = $this->addChildViewToData($templatePath, $templateData);

        return $this->include($baseTemplate, $templateData);
    }

    private function addChildViewToData($templatePath, $templateData)
    {
        $templateData[self::CHILD_VIEW_KEY] = $templatePath;

        return $templateData;
    }
}
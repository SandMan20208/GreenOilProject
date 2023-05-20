<?php

namespace common\components\request;

use common\models\active_records\Request;
use common\models\active_records\RequestStatus;

class RequestStatusHtmlGenerator
{
    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function generate(): string
    {
        switch ($this->request->status_id){
            case RequestStatus::STATUS_NEW_ID:
                return $this->generateStatusNewHtml();
            case RequestStatus::STATUS_PROCESSED_ID:
                return $this->generateStatusProcessedHtml();
            case RequestStatus::STATUS_EXECUTED_ID:
                return $this->generateStatusExecutedHtml();
            case RequestStatus::STATUS_CLOSED_ID:
                return $this->generateStatusClosedHtml();
        }
        return '';
    }

    private function generateStatusNewHtml(): string
    {
        return "<div class=\"status-request-container status-request-container_status-new\">{$this->request->status->status_name}</div>";
    }

    private function generateStatusProcessedHtml(): string
    {
        return "<div class=\"status-request-container status-request-container_status-processed\">{$this->request->status->status_name}</div>";
    }

    private function generateStatusExecutedHtml(): string
    {
        return "<div class=\"status-request-container status-request-container_status-executed\">{$this->request->status->status_name}</div>";
    }

    private function generateStatusClosedHtml(): string
    {
        return "<div class=\"status-request-container status-request-container_status-closed\">{$this->request->status->status_name}</div>";
    }

}
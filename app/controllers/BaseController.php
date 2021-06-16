<?php

class BaseController extends Phalcon\Mvc\Controller {

    /**
     * BaseController send code headers with formatted content.
     * @param integer $code
     * @param array $msg
     * @param array $errors
     * @return null
     */
    public function sendResponse($code, $msg, $errors = null) {
        $response = $this->response;
        $response->setStatusCode($code)->sendHeaders();
        $response->setContent($this->createMeta($msg, $errors));
        $response->send();
        return;
    }

    /**
     * BaseController handle routes not found.
     */
    public function notFound() {
        $this->sendResponse(404, null, ['404 not found']);
    }

    /**
     * BaseController create formatted json body for response.
     * @param array $data
     * @param array $errors
     * @return string
     */
    private function createMeta($data, $errors) {
        $content = [];
        $content['api_version'] = '1.0.0';

        if(is_null($data) && !is_null($errors)) {
            $content['errors'] = $errors;
        } else {
            $content['data'] = $data;
        }

        $msg = !array_key_exists('errors', $content) ? $content['data'] : $content['errors'];
        $meta = [];
        $meta['timestamp'] = date('Y-m-d H:i:s');
        $meta['hash'] = md5(json_encode($msg));
        $content['meta'] = $meta;

        return json_encode($content);
    }
}
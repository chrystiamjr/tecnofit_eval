<?php

class BaseController extends Phalcon\Mvc\Controller {
  
    public function sendResponse($code, $msg, $errors = null) {
        $response = $this->response;
        $response->setStatusCode($code)->sendHeaders();
        $response->setContent($this->createMeta($msg, $errors));
        $response->send();
        return;
    }

    public function notFound() {
        $this->sendResponse(404, null, ['404 not found']);
    }

    private function createMeta($data, $errors) {
        $content = [];
        $content['api_version'] = '1.0.0';

        if(is_null($data) && !is_null($errors)) {
            $content['errors'] = $errors;
        } else {
            if(is_string($data)) {
                $content['data'] = json_decode($data);
            } else {
                $content['data'] = $data;
            }
        }

        $msg = !array_key_exists('errors', $content) ? $content['data'] : $content['errors'];
        $hash = hash_hmac('sha1', json_encode($msg), 'tecnofit');

        $meta = [];
        $meta['timestamp'] = date('Y-m-d H:i:s');
        $meta['hash'] = $hash;
        $content['meta'] = $meta;

        return json_encode($content);
    }
}